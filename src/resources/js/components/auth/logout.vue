<template>

</template>

<script>
export default {
    created() {
        //Emitting the logout event (similar to delegates) and the Toolbar.vue will listen (observe) to this event
        EventBus.$emit('logout')
    }
}
</script>
