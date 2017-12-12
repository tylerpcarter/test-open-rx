<template>
  <div>
    <div class="uk-card uk-card-default">
      <div class="uk-card-header uk-card-primary">
        <h3 class="uk-card-title uk-margin-remove-bottom">{{ drug.name }}</h3>
        <p class="uk-text-meta uk-margin-remove-top">{{ brands }}</time></p>
      </div>
      <div class="uk-card-body">
        <h5><strong>{{ drug.type }}</strong></h5>
        <p>{{ drug.description }}</p>
      </div>
      <div class="uk-card-footer">
        <a @click="$emit('fart')" href="#" class="uk-button uk-button-text uk-align-right">Learn more</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'drug-card',
  props: [
    'drug'
  ],
  computed: {
    brands () {
      var brands = this.drug.brands
      var text = 'Common Brands: '
      for (var i = 0; i < brands.length; i++) {
        text = text.concat(brands[i].name)
        if (i === brands.length - 1) {
          text = text.concat('')
        } else if (i === brands.length - 2) {
          text = text.concat(', and ')
        } else {
          text = text.concat(', ')
        }
      }
      return text
    }
  },
  methods: {
    test () {
      console.log('hello')
    }
  },
  data () {
    return {
    }
  },
  mounted () {
  }
}
</script>

<style>
  @media only screen and (min-width: 500px) {
    .uk-card-body {
      min-height: 100px;
    }
  }

</style>
