<template>
    <div>
        <div class="relative z-30">
            <input
                aria-label="search"
                name="search"
                v-model.trim="term"
                id="search"
                autocomplete="off"
                type="text"
                class="w-64 px-8 py-2 text-sm bg-gray-300 rounded-full focus:outline-none focus:shadow-outline text-brand-dark"
                placeholder="Search Verified Creators"
            />
            <div class="absolute inset-y-0">
                <svg
                    class="w-5 pt-2 ml-2 text-gray-500 fill-current"
                    viewBox="0 0 24 24"
                >
                    <path
                        d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"
                    />
                </svg>
            </div>

            <div
                class="absolute inset-y-0 right-0 flex items-center mr-3"
                v-if="loading"
            >
                <svg
                    class="w-5 h-5 animate-spin text-brand-orange"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <circle
                        class="opacity-25"
                        cx="12"
                        cy="12"
                        r="10"
                        stroke="currentColor"
                        stroke-width="4"
                    ></circle>
                    <path
                        class="opacity-75"
                        fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                    ></path>
                </svg>
            </div>

            <div
                class="absolute z-50 w-64 mt-3 text-sm bg-gray-200"
                v-if="searchReady"
            >
                <ul class="divide-y divide-gray-400" v-if="results.length">
                    <li v-for="result in results" :key="result.id">
                        <a
                            :href="`creators/${result.channel}/${result.id}`"
                            class="flex items-center py-4 transition duration-150 ease-in-out text-brand-dark hover:bg-gray-700 hover:text-brand-light"
                            tabindex="-1"
                        >
                            <div class="w-4 h-4 ml-2">
                                <component
                                    v-bind:is="`${result.channel}-logo`"
                                    class="w-4 h-4"
                                ></component>
                            </div>
                            <span class="ml-2">{{ result.name }}</span>
                        </a>
                    </li>
                </ul>
                <div
                    class="px-3 py-3 text-brand-dark"
                    v-if="!results.length && !loading"
                >
                    No results for '{{ term }}'!
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import YoutubeLogo from "./Logos/YoutubeLogo.vue";
import WebsiteLogo from "./Logos/WebsiteLogo.vue";
import TwitterLogo from "./Logos/TwitterLogo.vue";
import TwitchLogo from "./Logos/TwitchLogo.vue";
import RedditLogo from "./Logos/RedditLogo.vue";
import VimeoLogo from "./Logos/VimeoLogo.vue";
import GithubLogo from "./Logos/GithubLogo.vue";

export default {
    components: {
        YoutubeLogo,
        GithubLogo,
        WebsiteLogo,
        RedditLogo,
        TwitchLogo,
        TwitterLogo,
        VimeoLogo,
    },
    data() {
        return {
            term: "",
            results: [],
            loading: false,
        };
    },
    computed: {
        searchReady() {
            return this.term.length >= 3;
        },
    },
    watch: {
        term: function (val) {
            this.search();
        },
    },
    methods: {
        search() {
            if (this.searchReady) {
                this.loading = true;
                axios.post(`/search?term=${this.term}`).then((response) => {
                    this.results = response.data;
                    this.loading = false;
                });
            } else {
                this.results = [];
            }
        },
    },
};
</script>
