<template>
    <div>
        <div class="relative z-30">
            <input
                aria-label="search"
                name="search"
                v-model.trim="term"
                id="search"
                @change="search"
                @keyup.enter="search"
                autocomplete="off"
                type="text"
                class="w-64 px-8 py-2 text-sm bg-gray-300 rounded-full focus:outline-none focus:shadow-outline text-brand-dark"
                placeholder="Search Verified Creators"
            />
            <div class="absolute inset-y-0">
                <svg
                    class="w-4 pt-3 ml-3 text-gray-500 fill-current"
                    viewBox="0 0 24 24"
                >
                    <path
                        class="heroicon-ui"
                        d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"
                    />
                </svg>
            </div>

            <div class="absolute inset-y-0 right-0 mr-4 spinner"></div>

            <div
                class="absolute z-50 w-64 mt-4 text-sm bg-gray-200"
                v-if="searchReady"
            >
                <ul class="divide-y divide-gray-400" v-if="results.length">
                    <li v-for="result in results" :key="result.id">
                        <a
                            :href="`creators/${result.channel}/${result.id}`"
                            class="flex items-center py-4 transition duration-150 ease-in-out text-brand-dark hover:bg-gray-700 hover:text-brand-light"
                            tabindex="-1"
                        >
                            <div class="w-4 h-4 ml-2"></div>
                            <span class="ml-2">{{ result.name }}</span>
                        </a>
                    </li>
                </ul>
                <div class="px-3 py-3 text-brand-dark" v-else>
                    No results for '{{ term }}'!
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            term: "",
            results: [],
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
                axios
                    .post(`/search?term=${this.term}`)
                    .then((response) => (this.results = response.data));
            } else {
                this.results = [];
            }
        },
    },
};
</script>

<style></style>
