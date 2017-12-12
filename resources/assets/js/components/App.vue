<template>
  <div>
    <transition name="fade">
      <div v-show="fart" class="full-card">
        <p>Hello</p>
        <button @click="fart=!fart">Close</button>
      </div>
    </transition>
    <nav class="uk-navbar-container" style="padding: 0 20px;" uk-navbar>
      <div class="uk-navbar-left">
        <ul class="uk-navbar-nav">
          <li class="uk-active"><a href="#">Make Rx</a></li>
        </ul>
      </div>
      <div class="uk-navbar-right">
        <ul class="uk-iconnav">
          <li><a href="#" uk-icon="icon: menu" uk-toggle="target: #offcanvas-nav-primary"></a></li>
        </ul>
      </div>
    </nav>
    <div class="uk-offcanvas-content">
      <div id="offcanvas-nav-primary" uk-offcanvas="mode: push">
        <div class="uk-offcanvas-bar uk-flex uk-flex-column">
          <ul class="uk-nav uk-nav-primary uk-nav-center uk-margin-auto-vertical">
              <li class="uk-active"><a href="#">Active</a></li>
              <li class="uk-parent">
                  <a href="#">Parent</a>
                  <ul class="uk-nav-sub">
                      <li><a href="#">Sub item</a></li>
                      <li><a href="#">Sub item</a></li>
                  </ul>
              </li>
              <li class="uk-nav-header">Header</li>
              <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: table"></span> Item</a></li>
              <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Item</a></li>
              <li class="uk-nav-divider"></li>
              <li><a href="#"><span class="uk-margin-small-right" uk-icon="icon: trash"></span> Item</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="uk-container" style="background-color: #222;">
      <div class="uk-grid-collapse uk-child-width-expand@s uk-grid-match drugsi" uk-grid>
        <div v-show="show" class="f">
          <div class="uk-background-secondary uk-padding-small">
            <input class="uk-input" v-model="name" type="text" placeholder="Name">
          </div>
        </div>
        <div v-show="show" class="f">
          <div class="uk-background-secondary uk-padding-small">
            <select class="uk-select">
              <option>Class</option>
              <option>Class</option>
            </select>
          </div>
        </div>
        <div v-show="show" class="f">
          <div class="uk-background-secondary uk-padding-small">
            <select class="uk-select">
              <option>Schedule</option>
              <option>Schedule</option>
            </select>
          </div>
        </div>
        <div>
          <div class="uk-background-secondary uk-padding-small uk-light uk-child-width-1-3" uk-grid>
            <div class="btn-cont">
              <button @click="add" class="uk-icon-button" :class="{ test: newdrug }" uk-icon="icon: plus"></button>
            </div>
            <div class="btn-cont">
              <button @click="show=!show" class="uk-icon-button" uk-icon="icon: settings"></button>
            </div>
            <div class="btn-cont">
              <button class="uk-icon-button" uk-icon="icon: refresh"></button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div v-show="newdrug" class="overlay">
    </div>

    <div v-show="drugsi" class="uk-container uk-margin">
      <div class="uk-child-width-1-2@m uk-grid-small uk-grid-match" uk-grid>
        <drug-card
          v-for="drug in filteredDrugs"
          :key="drug.id"
          :drug="drug"
          @fart="fart=!fart"
        ></drug-card>
      </div>
    </div>

  </div>
</template>

<script>
  import DrugCard from './DrugCard'
  import _ from 'lodash'
  export default {
    name: 'app',
    components: {
      DrugCard
    },
    computed: {
      filteredDrugs () {
        console.log('filtering the drugs bruh')
        var self = this
        return this.drugs.filter(drug => {
          return drug.name.toLowerCase().indexOf(self.name.toLowerCase()) > -1
        })
      }
    },
    data () {
      return {
        show: true,
        drugsi: true,
        newdrug: false,
        drugs: [],
        name: '',
        type: 1,
        schedule: 1,
        fart: false
      }
    },
    methods: {
      add () {
        if (this.newdrug === true) {
          this.drugsi = true
          this.newdrug = false
        } else {
          this.drugsi = false
          this.newdrug = true
        }
      }
    },
    created () {
      var self = this
      axios.get('/drugs')
        .then(function (response) {
          var data = response.data
          console.log(data)
          self.drugs = data
        })
        .catch(function (error) {
          console.log(error)
        })
    }
  }
</script>

<style>
  .overlay {
    width: 100%;
    height: calc(100vh - 146px);
    background-color: black;
  }
  .test {
    transform: rotateZ(45deg);
  }
  body {
    font-family: 'Roboto', sans-serif;
  }
  .uk-card {
    border-radius: 5px;
    overflow: hidden;
  }
  .uk-card-title {
    color: white !important;
  }
  .f {
    transition: all 0.5s;
  }
  .btn-cont {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .test {
    background-color: pink;
  }
  .full-card {
    width: 100%;
    height: calc(100vh - 80px);
    background-color: pink;
    position: absolute;
    top: 80px;
    left: 0;
    z-index: 100;
  }

  .fade-enter-active, .fade-leave-active {
    transition: all .5s
  }
  .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
    left: 100vw;
  }

</style>
