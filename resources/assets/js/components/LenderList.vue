<template>
    <div class="col-12">
        <div class="row">
            <div class="col-lg-8">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="searchTerm">Location</label>
                            <input type="text" class="form-control" id="searchTerm" aria-describedby="emailHelp" placeholder="City, State/Territory or ZIP" @change="getLocation" v-model="location">
                            <ul class="list-group position-absolute" v-show="this.locations.length > 0">
                                <li class="list-group-item" v-for="location in locations"><a href="#" v-text="location" @click="selectLocation(location)"></a></li>
                            </ul>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="searchTerm">Name</label>
                            <input type="text" class="form-control" id="searchTerm" aria-describedby="emailHelp" placeholder="Loan Officer or bank" v-model="name">
                        </div>
                        <div class="form-group col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-primary" @click="searchByBankName">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div>
            <div class="card" v-for="lender in lenders">
                <div class="card-body">
                    <div class="media">
                        <a :href="getPublicURL(lender.screenName)" target="_new"><img class="mr-3" :src="getImageURL(lender.id, lender.imageId)" alt="Generic placeholder image" style="height: 100px;"></a>
                        <div class="media-body">
                            <a :href="getPublicURL(lender.screenName)" target="_new"><h5 class="mt-0" v-text="getCompanyName(lender)"></h5></a>
                            <p class="small text-muted mb-1" v-text="`NMLS# ${lender.nmlsId}`"></p>
                            <p class="small text-muted mb-1" v-text="`Rating: ${lender.rating}`"></p>
                            <p class="small text-muted mb-1"> {{ `${lender.recentReviews} reviews`}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        data() {
            return {
                lenders: [],
                name: "",
                location: "",
                locations: []
            }
        },
        methods: {
            getLocation() {
                if (this.location.length >= 2 && this.name.length == 0) {
                    axios.get(`places/${this.location}`).then(response => {
                        if (response.status == 200) {
                            this.locations = response.data.locations
                        }
                    })
                } else {
                    this.locations = []
                }
            },
            getImageURL(id, imageId) {
                    return `https://mortgageapi.zillow.com/getLenderProfileImage?lenderId=${id}&imageId=${imageId}&treatment=100x100`
            },
            getPublicURL(name) {
                return `https://www.trulia.com/mortgage-lender-profile/${name}`
            },
            selectLocation(location) {
                this.location = location
                this.locations = []
                axios.get(`locations/${location}`).then(response => {
                    if (response.status == 200) {
                        this.lenders = response.data.lenders
                    } else {
                        Error('Something went wrong with fetching cj')
                    }
                })
            },
            searchByBankName() {
                this.locations = []
                if (this.location.length == 0) {
                    axios.get(`lenders/${this.name}`).then(response => {
                        if (response.status == 200) {
                            this.lenders = response.data.lenders
                        } else {
                            Error('Something went wrong with fetching cj')
                        }
                    })
                } else {
                    axios.get(`locations/${this.location}/lenders/${this.name}`).then(response => {
                        if (response.status == 200) {
                            this.lenders = response.data.lenders
                            this.locations = []
                        } else {
                            Error('Something went wrong with fetching cj')
                        }
                    })
                }


            },
            getCompanyName(lender) {
                if (lender.companyName) {
                    return lender.companyName
                }
                var firstName = lender.individualName.firstName ? lender.individualName.firstName : ""
                var middleName = lender.individualName.middleName ? lender.individualName.middleName : ""
                var lastName = lender.individualName.lastName
                return `${firstName} ${middleName} ${lastName}`
            }
        },
    }
</script>
<style scoped>
    ul {
        z-index: 99;
    }
</style>
