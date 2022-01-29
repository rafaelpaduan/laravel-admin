<template>
    <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark">
                <!-- <NuxtLink to="http://padutech.com.br"> -->
                    <img src="/img/padutech_logo.png" width="110" height="32" alt="Tabler" class="navbar-brand-image">
                <!-- </NuxtLink> -->
            </h1>
            <div class="navbar-nav flex-row d-lg-none"></div>

            <br>

            <div class="row g-2 align-items-center">
                <div class="col-auto">
                    <span class="avatar avatar-sm" style="background-image: url(/img/profile.png)"></span>
                </div>
                <div class="col">
                    <h4 class="card-title m-0">
                        <a href="#">Mallory Hulme</a>
                    </h4>
                    <div class="small mt-1">
                        <span class="badge bg-green"></span> Online
                    </div>
                </div>
            </div>

            <hr>
            
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-it">
                        <NuxtLink class="nav-link" to="/">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <!-- <i class="fas fa-home"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="5 12 3 12 12 3 21 12 19 12"></polyline><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
                            </span>
                            <span class="nav-link-title">
                                Home
                            </span>
                        </NuxtLink>
                    </li>
                    <li class="nav-it">
                        <NuxtLink class="nav-link" to="/tickets">
                            <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <!-- <i class="fas fa-ticket"></i> -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="15" y1="5" x2="15" y2="7"></line><line x1="15" y1="11" x2="15" y2="13"></line><line x1="15" y1="17" x2="15" y2="19"></line><path d="M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-3a2 2 0 0 0 0 -4v-3a2 2 0 0 1 2 -2"></path></svg>
                            </span>
                            <span class="nav-link-title">
                                Ticket
                            </span>
                        </NuxtLink>
                    </li>

                </ul>
          </div>
        </div>
    </aside>
</template>

<style scoped>

hr {
    margin-top: 30px;
    margin-bottom: 10px;
}

.nav-pills .nav-it .active {
    color: white;
    background-color: #206bc4 !important;
}

</style>