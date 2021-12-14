import $ from 'jquery';

class Search{
    // 1. describe and create/initiate our object
    constructor(){
        this.addSearchHTML();
        this.resultsDiv = $("#search-overlay__results");
        this.openButton = $(".js-search-trigger");
        this.closeButton = $(".search-overlay__close");
        this.searchOverlay = $(".search-overlay");
        this.searchField = $("#search-term");
        this.typingTimer;
        this.isSpinnerVisible = false;
        this.previousValue;
        this.events();
    }

    // 2. events
    events(){
        this.openButton.on("click", this.openOverlay.bind(this));
        this.closeButton.on("click", this.closeOverlay.bind(this));
        $(document).on("keydown", this.keyPress.bind(this));
        this.searchField.on("keyup", this.typingLogic.bind(this));
    }

    // 3. methods
    typingLogic(){
        if(this.searchField.val() != this.previousValue){
            clearTimeout(this.typingTimer);

            if(this.searchField.val()){
                if(!this.isSpinnerVisible){
                    this.resultsDiv.html('<div class="spinner-loader"></div>');
                    this.isSpinnerVisible = true;
                }
                this.typingTimer = setTimeout(this.getResults.bind(this), 750);
            }else{
                this.resultsDiv.html('');
                this.isSpinnerVisible = false;
            }
        }

        this.previousValue = this.searchField.val();
    }

    getResults(){
        $.getJSON(demoData.rootUrl + '/wp-json/demo/v1/search?term=' + this.searchField.val(), results => {
            this.resultsDiv.html(`
                <div class="row">
                    <div class="col-lg-3">
                        <h3 class="search-overlay__section-title my-4 text-center">General Information</h3>
                        ${results.generalInfo.length ? '<ul class="link-list min-list">' : '<p>No general information matches that search.</p>'}
                        ${results.generalInfo.map(item => `<li><a class="general-info-title" href="${item.permalink}">${item.title} ${item.postType == 'post' ? ` by ${item.authorName}` : ''}</a></li>`).join('')}
                        ${results.generalInfo.length ? '</ul>' : ''}
                    </div>
                    <div class="col-lg-3">
                        <h3 class="search-overlay__section-title my-4 text-center">Movies</h3>
                        ${results.movies.length ? '<ul class="link-list min-list p-0">' : `<p>No movie matches that search. <a href="${demoData.rootUrl}/movies">View all movies here.</a></p>`}
                        ${results.movies.map(item => `
                            <div class="single-card mb-3">
                                <a href="${item.permalink}">
                                    <div class="card-image-container-search">
                                        <img src="${item.image}"
                                            class="fit-image">
                                    </div>
                                </a>
                                <div class="description d-none d-md-flex">
                                    <h4>
                                        <a href="${item.permalink}">
                                            ${item.title}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        `).join('')}
                        ${results.movies.length ? '</ul>' : ''}
                    </div>
                    <div class="col-lg-3">
                        <h3 class="search-overlay__section-title my-4 text-center">Books</h3>
                        ${results.books.length ? '<ul class="link-list min-list p-0">' : `<p>No book matches that search. <a href="${demoData.rootUrl}/books">View all books here.</a></p>`}
                        ${results.books.map(item => `
                            <div class="single-card mb-3">
                                <a href="${item.permalink}">
                                    <div class="card-image-container-search">
                                        <img src="${item.image}"
                                            class="fit-image">
                                    </div>
                                </a>
                                <div class="description d-none d-md-flex">
                                    <h4>
                                        <a href="${item.permalink}">
                                            ${item.title}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        `).join('')}
                        ${results.books.length ? '</ul>' : ''}
                    </div>
                    <div class="col-lg-3">
                        <h3 class="search-overlay__section-title my-4 text-center">Games</h3>
                        ${results.games.length ? '<ul class="link-list min-list p-0">' : `<p>No game matches that search. <a href="${demoData.rootUrl}/games">View all games here.</a></p>`}
                        ${results.games.map(item => `
                            <div class="single-card mb-3">
                                <a href="${item.permalink}">
                                    <div class="card-image-container-search">
                                        <img src="${item.image}"
                                            class="fit-image">
                                    </div>
                                </a>
                                <div class="description d-none d-md-flex">
                                    <h4>
                                        <a href="${item.permalink}">
                                            ${item.title}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        `).join('')}
                        ${results.games.length ? '</ul>' : ''}
                    </div>
                </div>
            `);
            this.isSpinnerVisible = false;
        });
    }

    keyPress(e){
        if(e.keyCode == 83 && !$("input, textarea").is(':focus')){
            this.openOverlay();
        }

        if(e.keyCode == 27){
            this.closeOverlay();
        }
    }

    openOverlay(){
        this.searchOverlay.addClass("search-overlay--active");
        $("body").addClass("body-no-scroll");
        this.searchField.val('');
        setTimeout(() => this.searchField.focus(), 301);
    }

    closeOverlay(){
        this.searchOverlay.removeClass("search-overlay--active");
        $("body").removeClass("body-no-scroll");
    }

    addSearchHTML(){
        $("body").append(`
        <!-- START OF SEARCH -->
        <div class="search-overlay">
            <div class="search-overlay__top d-flex">
                <div class="container d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
                        <input type="text" class="search-term" placeholder="Search..." id="search-term">
                    </div>                
                    <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
                </div>
            </div>
        
            <div class="container">
                <div id="search-overlay__results"></div>
            </div>
        
        </div>
        <!-- END OF SEARCH -->
        `);
    }
}

export default Search;