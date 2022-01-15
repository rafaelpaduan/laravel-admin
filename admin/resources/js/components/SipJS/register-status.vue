<template>
    
    <div class="info-box">
        <span :class="'info-box-icon bg-' + (this.$store.state.register == true ? 'success' : 'danger')"><i class="fas fa-phone-alt"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Status</span>
            <span class="info-box-number"></span>
        </div>
    </div>
</template>

<script>
    export default {

    }
</script>
