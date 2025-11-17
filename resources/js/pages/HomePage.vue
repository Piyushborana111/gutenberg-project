<template>
    <div class="bg-background">
        <div class="container">
            <h1 class="heading-title">Gutenberg Project</h1>

            <p class="intro-text">
                A social cataloging website that allows you to freely search its
                database of books, annotations, and reviews.
            </p>

            <div>
                <button
                    v-for="cat in categories"
                    :key="cat"
                    class="category-btn"
                    @click="go(cat)"
                >
                    <img
                        :src="`/images/${cat}.svg`"
                        :alt="cat"
                        class="category-icon"
                    />

                    {{ cat }}
                    <img :src="`/images/Next.svg`" class="category-next-icon" />
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: [
                "Fiction",
                "Philosophy",
                "Drama",
                "History",
                "Humour",
                "Adventure",
                "Politics",
            ],
        };
    },
    methods: {
        go(cat) {
            window.location.href = `/books/${cat}`;
        },
        getIcon(cat) {
            return new URL(`/assets/images/${cat}.svg`, import.meta.url).href;
        },
    },
};
</script>
