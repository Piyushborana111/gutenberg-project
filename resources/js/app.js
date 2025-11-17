import "./bootstrap";

// resources/js/app.js
import { createApp } from "vue";

import HomePage from "./pages/HomePage.vue";
import BooksPage from "./pages/BooksPage.vue";

const app = createApp({});

app.component("home-page", HomePage);
app.component("books-page", BooksPage);

app.config.globalProperties.$api = "http://skunkworks.ignitesol.com:8000";
app.mount("#app");
