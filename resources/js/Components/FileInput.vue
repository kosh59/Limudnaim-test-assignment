<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

const input = ref(null);

</script>

<template>
    <input
        class="form-control"
        @input="$emit('update:modelValue', $event.target.files[0])"
        accept="image/*"
        type="file"
        ref="fileInput"
    />
</template>
