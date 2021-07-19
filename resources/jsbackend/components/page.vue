<template>
	<nav aria-label="Page navigation example">
		<ul class="pagination justify-content-end">
			<li class="page-item" @click.prevent="prev()"><a class="page-link" href="#">Previous</a></li>
			<li class="page-item" :class="{'active': currentPage==page}" @click.prevent="setPage(page)" v-for="page in pagesNumber" :key="page"><a class="page-link" href="#">{{ page }}</a></li>
			<li class="page-item" @click.prevent="next()"><a class="page-link" href="#">Next</a></li>
		</ul>
	</nav>
</template>

<script>
export default {
    data(){
    	return{
			currentPage: 1,
			offset: 4,
			from:'',
			to:'',
		}
    },
    props:['last_pages'],
	computed: {
            pagesNumber() {
				if(this.last_page<=this.offset*2+1){
					this.from = 1;
					this.to = this.last_page;
				}else{
					if(this.currentPage <= this.offset){
						this.from = 1;
						this.to = 1 + this.offset*2;
						if(this.to > this.last_page){
							this.to = this.last_page;
						}
					}
					if((this.currentPage> this.offset) && (this.currentPage <= this.last_page - this.offset)){
						this.from = this.currentPage - this.offset;
						this.to = this.currentPage + this.offset;
					}
					if(this.currentPage >this.last_page - this.offset){
						this.from = this.last_page - this.offset*2;
						this.to = this.last_page;
					}
				}
                var pagesArray = [];
                for (var i=this.from; i <= this.to; i++) {
                    pagesArray.push(i);
                }
                return pagesArray;
            },
			last_page(){
				return this.last_pages;
			}
        },
	methods:{
		setPage(newPage){
			this.currentPage = newPage;
			this.$emit('getPage', this.currentPage);
		},
		prev(){
			if(this.currentPage > 1){
				this.currentPage--;
				this.$emit('getPage', this.currentPage);
			}
		},
		next(){
			if(this.currentPage < this.last_page){
				this.currentPage++;
				this.$emit('getPage', this.currentPage);
			}
		}
	},
	
}
</script>

<style>

</style>