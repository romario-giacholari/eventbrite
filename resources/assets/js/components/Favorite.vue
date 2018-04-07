<template>
    <button type ='submit' :class ='classes' @click="toggle">
		<span v-text="favoritesCount"></span> <i class="fa fa-heart" aria-hidden="true"></i>
	</button>
</template>

<script>
    export default {
    
      props:['data'],

       data() {
           return {
               favoritesCount : this.data.favoritesCount,
               isFavorited : this.data.isFavorited
           }
       },
       computed: {
           classes() { 
            return ['btn', this.isFavorited ? 'btn-primary' : 'btn-default'];
           },
           endpoint(){
              return '/model/' + this.data.id + '/favorites';
           }
       },
       methods: {
           toggle() {
            
            return this.isFavorited ? this.destroy() : this.create();
           },
           create() {
                   axios.post(this.endpoint);
                   this.isFavorited = true;
                   this.favoritesCount ++;
                   flash('Liked');
           },
           destroy() {
                   axios.delete(this.endpoint);
                   this.isFavorited = false;
                   this.favoritesCount --;
                   flash('Disliked');
           }
       }
    }
</script>