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
            link.classList.add("post__link");
            link.href = post.permalink;
            link.target = "_blank";

            const img = document.createElement("img");
            img.classList.add("post__image");
            img.src = post.media_type === "VIDEO" ? post.thumbnail_url : post.media_url;
            img.alt = "Instagram Post";


            link.appendChild(img);
            postElement.appendChild(link);
            postsContainer.appendChild(postElement);
        });

    } catch (error) {
        console.error(error);
        postsContainer.innerHTML = "<p>エラーが発生しました。</p>";
    }
});
