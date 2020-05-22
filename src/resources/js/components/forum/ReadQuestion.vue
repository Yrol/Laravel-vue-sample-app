<template>

</template>

<script>
import axios, {AxiosResponse} from 'axios';
export default {
    data() {
        return {
            question: {}
        }
    },
    created() {
        axios.get(`/api/questions/${this.$route.params.slug}`)// Using the Vue Route to get the questiob by slug
        .then(res => this.question = res.data.data)
    }
}
</script>
