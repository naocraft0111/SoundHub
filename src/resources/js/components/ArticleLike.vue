<template>
    <div class="article__like">
        <button type="button" class="btn shadow-none border-0 article__like__button">
            <span class="article__like__button__span">
                <i class="fa-regular fa-heart article__like__button__span__tap-area" aria-hidden="true"
                    :class="{'text-danger':this.isLikedBy, 'fa-solid fa-heart':this.isLikedBy,'Heart1':this.gotToLike}"
                    @click="clickLike"
                />
            </span>
        </button>
        <p class="m-0" :class="{'text-danger':this.isLikedBy}">
            {{ countLikes }}
        </p>
    </div>
</template>

<script>
    export default {
        props: {
            initialIsLikedBy: {
                type: Boolean,
                default: false,
            },
            initialCountLikes: {
                type: Number,
                default: 0,
            },
            authorized: {
                type: Boolean,
                default: false,
            },
            endpoint: {
                type: String,
            },
        },
        data() {
            return {
                isLikedBy: this.initialIsLikedBy,
                countLikes: this.initialCountLikes,
                gotToLike: false,
            }
        },
        methods: {
            clickLike() {
                if(!this.authorized) {
                    alert('いいね機能はログイン中のみ使用できます')
                    return
                }

                this.isLikedBy
                    ? this.unlike()
                    : this.like()
            },
            async like() {
                const response = await axios.put(this.endpoint)

                this.isLikedBy = true
                this.countLikes = response.data.countLikes
                this.gotToLike = true
            },
            async unlike() {
                const response = await axios.delete(this.endpoint)

                this.isLikedBy = false
                this.countLikes = response.data.countLikes
                this.gotToLike = false
            },
        },
    }
</script>
<style>
.Heart1{
    animation: anime1 2s reverse;
}

@keyframes anime1{
0% { transform: scale(1); }
60% { transform: scale(1); }
70% { transform: scale(1.3); }
80% { transform: scale(1); }
90% { transform: scale(1.3); }
100% { transform: scale(1); }
}
</style>
