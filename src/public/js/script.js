document.addEventListener("DOMContentLoaded", async function () {
    const postsContainer = document.getElementById("posts-container");

    try {
        // JSONデータを取得
        const response = await fetch("/api/instagram.php");
        if (!response.ok) throw new Error("Failed to fetch Instagram posts.");

        const posts = await response.json();

        if (posts.length === 0) {
            postsContainer.innerHTML = "<p>投稿がありません。</p>";
            return;
        }

        // 投稿を動的に追加
        posts.forEach(post => {
            const postElement = document.createElement("div");
            postElement.classList.add("post");

            const link = document.createElement("a");
            link.href = post.permalink;
            link.target = "_blank";

            const img = document.createElement("img");
            img.src = post.media_type === "VIDEO" ? post.thumbnail_url : post.media_url;
            img.alt = "Instagram Post";

            const caption = document.createElement("p");
            caption.textContent = post.caption || "No Caption";

            link.appendChild(img);
            postElement.appendChild(link);
            postElement.appendChild(caption);
            postsContainer.appendChild(postElement);
        });

    } catch (error) {
        console.error(error);
        postsContainer.innerHTML = "<p>エラーが発生しました。</p>";
    }
});
