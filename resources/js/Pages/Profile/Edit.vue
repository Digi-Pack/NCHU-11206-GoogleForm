<script setup>
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';

defineProps({
  mustVerifyEmail: Boolean,
  status: String,
});
</script>

<template>
  <div class="min-h-screen relative z-10 px-[40px]">
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <UpdateProfileInformationForm
            :must-verify-email="mustVerifyEmail"
            :status="status"
            class="max-w-xl"
          />
        </div>
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
          <UpdatePasswordForm class="max-w-xl" />
        </div>
      </div>
    </div>
  </div>
</template>
