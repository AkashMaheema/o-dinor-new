document.addEventListener("DOMContentLoaded", function() {
    const blogPosts = document.querySelectorAll(".blog-post");

    const showOnScroll = () => {
        const scrollTop = window.scrollY;
        const windowHeight = window.innerHeight;

        blogPosts.forEach(post => {
            const postTop = post.getBoundingClientRect().top + scrollTop;

            if (scrollTop + windowHeight - 100 > postTop) {
                post.classList.add("show");
            }
        });
    };

    window.addEventListener("scroll", showOnScroll);
    showOnScroll();  
});
