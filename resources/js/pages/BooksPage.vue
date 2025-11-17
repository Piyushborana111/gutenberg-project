<template>
    <div class="header-part">
        <div class="container">
            <h2>
                <img
                    :src="`/images/Back.svg`"
                    @click="back()"
                    class="category-back-icon"
                />
                {{ category }}
            </h2>
            <div class="search-container">
                <div class="search-icon">
                    <img
                        :src="`/images/Search.svg`"
                        class="category-search-icon"
                    />
                </div>
                <input
                    v-model="search"
                    @input="fetchBooks(true)"
                    class="search-box"
                    placeholder="Search"
                />
            </div>
        </div>
    </div>
    <div class="grey-bg">
        <div class="container">
            <div class="grid-box">
                <div v-for="b in books" :key="b.id" @click="openBook(b)">
                    <div class="book-image-container">
                        <img
                            :src="b.formats['image/jpeg']"
                            class="book-image"
                        />
                    </div>
                    <h5 class="book-name">{{ b.title }}</h5>
                    <p
                        class="author-name"
                        v-if="b.authors && b.authors[0] && b.authors[0].name"
                    >
                        {{ b.authors[0].name }}
                    </p>
                </div>
            </div>
            <div ref="loader" class="text-center-custom">Loading more...</div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["category"],

    data() {
        return {
            books: [],
            nextPage: null,
            search: "",
            observer: null,
        };
    },

    mounted() {
        this.fetchBooks(true);
        this.setupScroll();
    },

    methods: {
        async fetchBooks(reset = false) {
            let url = `${this.$api}/books?topic=${this.category}&mime_type=image%2F`;

            if (this.search.trim()) {
                url += `&search=${this.search}`;
            }

            if (!reset && this.nextPage) {
                url = this.nextPage;
            }

            if (reset) {
                this.books = [];
                this.nextPage = null;
            }

            const res = await fetch(url);
            const data = await res.json();

            this.books.push(...data.results);
            this.nextPage = data.next;
        },

        setupScroll() {
            this.observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting && this.nextPage) {
                    this.fetchBooks();
                }
            });
            this.observer.observe(this.$refs.loader);
        },

        openBook(book) {
            const formats = book.formats;

            const order = [
                "text/html",
                "text/html; charset=utf-8",
                "application/pdf",
                "text/plain",
                "text/plain; charset=utf-8",
            ];

            for (let type of order) {
                if (formats[type] && !formats[type].endsWith(".zip")) {
                    window.open(formats[type], "_blank");
                    return;
                }
            }

            alert("No viewable version available");
        },
        back() {
            window.location.href = `/`;
        },
    },
};
</script>
