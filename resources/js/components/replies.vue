<template>
	<div>

	    <div class="media mt-3" v-for="reply in replies.data">
	        <a class="mr-3" href="#">
	            <avatar :username="reply.user.name" class="mr-3" :size="30"></avatar>
	        </a>
	        <div class="media-body">
	            <h6 class="mt-0">{{ reply.user.name }}</h6>
	            <small >{{ reply.body }}</small>
	            <votes :default_votes="reply.votes" :entity_id="reply.id" :entity_owner="reply.user.id"></votes>
	        </div>
	    </div>
		<div v-if="comment.repliesCount > 0 && replies.next_page_url" class="text-center">
    		<button v-if="replies.next_page_url" @click="fetchReplies" class="btn btn-outline-primary btn-sm">Load Replies</button>
    		<span v-if="!replies.next_page_url">No more replies to show :)</span>
		</div>
	</div>
</template>

<script>
	import Avatar from 'vue-avatar'	

	export default {
		props: ['comment'],
		components: {
			Avatar
		},
		data() {
			return {
				replies: {
					data: [],
					next_page_url: `/comments/${this.comment.id}/replies`
				}
			} 	
		},
		methods: {
			fetchReplies() {
				// const url = this.replies.next_page_url ? this.replies.next_page_url : `/comments/${this.comment.id}/replies`
				axios.get(this.replies.next_page_url).then(({ data }) => {
					this.replies = {
						...data,
						data: [
							...this.replies.data,
							...data.data
						]
					}
				})
			},
			addReply(reply) {
				this.replies = {
					...this.replies,
					data : [
						reply,
						...this.replies.data
					]
				}
			}
		}
	}
</script>