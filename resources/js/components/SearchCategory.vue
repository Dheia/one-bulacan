<template>
    <div class="container-fluid p-t-10 p-b-10">
        <div class="row">
            <div class="col-md-11 col-sm-10" style="padding: 0; margin: 0">
                <input style="border-radius: 0px; width: 100%; margin-bottom: 0px;" v-model="searchbar" @keyup.enter="searchNow()" type="text" class="form-control" id="search" placeholder="Search category...">
            </div>
            <div class="col-md-1 col-sm-2"  style="padding: 0; margin: 0">
                <a href="#" @click="searchNow()" class="btn btn-primary btn-block form-control" style="border-radius: 0;">Search</a>
            </div>
        </div>

        <!-- Students Modal -->
        <div id="searchModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Search &nbsp;
                        <small>
                            [ <span id="currentPage">{{ currentPage }}</span> - <span id="lastPage">{{ lastPage }}</span> ]
                        </small>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- Searching GIF / Magnifying Glass GIF -->
                    <div class="text-center" v-if="isSearching">
                        <img class="img-responsive" v-bind:src="'/images/magnify-glass-200px.gif'" alt="Searching..." style="margin: auto;">
                        <h3 class="text-center">Searching for "{{ searchbar }}"</h3>
                    </div>
                    <center v-else>
                        <!-- Loading GIF -->
                        <div v-if="isLoading" class="p-5">
                            <img class="img-responsive" v-bind:src="'/vendor/backpack/crud/img/ajax-loader.gif'" alt="Loading..." style="margin: auto;">
                        </div>
                        <table class='table table-striped table-bordered search-category-modal' v-else-if="totalSearch > 0">
                            <thead>
                                <th>Category</th>
                            </thead>
                            <tbody>
                                <tr v-for="category in searchItems" :id="'category-' + category.id">
                                    <td style='vertical-align:middle'><a v-bind:href="'/businesses/' + category.slug"> {{ category.name }} </a></td>
                                </tr>
                            </tbody>
                        </table>

                        <h3 class="text-center" v-else>No search result for "{{ searchbar }}"</h3>

                        <nav aria-label="Page navigation example" v-if="!isLoading && totalSearch > 0">
                          <ul class="pagination justify-content-center m-b-0 m-t-0">
                            <li class="page-item">
                              <a href="javascript:void(0)" class="page-link" @click="requestPage(prevPage)" v-if="prevPage !== null">Previous</a>
                            </li>
                            <li class="page-item">
                              <a href="javascript:void(0)" class="page-link" @click="requestPage(nextPage)" v-if="nextPage !== null">Next</a>
                            </li>
                          </ul>
                        </nav>
                    </center>
                </div>
            </div>
            </div>
        </div>
    </div>


</template>

<script>
    //import UserBookTransactions from './UserBookTransactions.vue';


    export default {
        data() {
            return {
                searchbar: null,
                searchItems: [],
                baseUrl: location.protocol + '//' + location.host,
                nextPage: null,
                prevPage: null,
                currentPage: null,
                lastPage: null,
                totalSearch: 0,
                isSearching: true,
                isLoading: true
            }
        },
        methods: {

            requestPage(url) {
                this.isLoading = true;
                axios.get(url)
                    .then(response => {
                        this.searchItems = response.data.data;
                        if(response.data.next_page_url){    
                            this.nextPage    = response.data.next_page_url+ '&search=' + this.searchbar;
                        }
                        else{
                            this.nextPage    = response.data.next_page_url;
                        }
                        if(response.data.prev_page_url){    
                            this.prevPage   = response.data.prev_page_url+ '&search=' + this.searchbar;
                        }
                        else{
                            this.prevPage   = response.data.prev_page_url;
                        }
                        this.currentPage = response.data.current_page;
                        this.lastPage    = response.data.last_page;
                        this.isLoading = false;
                    });
            },

            searchNow() {
                if(this.searchbar == null || this.searchbar === '') {
                    alert("Please enter a keyword");
                    return false;
                }
                this.isSearching = true;
                $('#searchModal').modal('toggle');

                axios.get('/categories/category?search=' + this.searchbar)
                    .then(response => {
                        
                        this.searchItems = response.data.data;
                        if(response.data.next_page_url){    
                            this.nextPage    = response.data.next_page_url+ '&search=' + this.searchbar;
                        }
                        else{
                            this.nextPage    = response.data.next_page_url;
                        }
                        if(response.data.prev_page_url){    
                            this.prevPage   = response.data.prev_page_url+ '&search=' + this.searchbar;
                        }
                        else{
                            this.prevPage   = response.data.prev_page_url;
                        }
                        this.currentPage = response.data.current_page;
                        this.lastPage    = response.data.last_page;
                        this.totalSearch = response.data.total;
                        this.isSearching = false;
                        this.isLoading   = false;
                    });
            },
        },

        created() {
            // console.log("Reading");
        },
        components: {

        }
    };
</script>


