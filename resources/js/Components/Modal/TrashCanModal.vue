<script>
import close from '/images/close.svg';
import { router } from '@inertiajs/vue3';

export default {
  props: {
    formUrl: String,
    coFormId: String,
    formTitle: String,

  },
  emits: [
    'closeModel',
  ],
  data() {
    return {
      close,
    };
  },
  methods: {
    closing() {
      this.$emit('closeModel');
    },
    submitDataId() {
      const deleteFormId = parseInt(this.coFormId, 10);
      router.visit(route('edit.delete'), {
        method: 'delete', data: { deleteFormId }, preserveState: true,
        onSuccess: ({ props }) => {
          if (props.flash.message.rt_code === 1) {
            Swal.fire({
              title: '表單已刪除',
              showDenyButton: false,
              confirmButtonText: '確定，回列表',
              denyButtonText: '',
            }).then((result) => {
              if (result.isConfirmed) {
                router.get(route('guide.index'));
              }
            });
          }
        },
      });
    },
  },
};
</script>

<template>
  <section id="TrashCanModal">
    <div class="container">
      <div class="content">
        <div class="flex justify-between items-center">
          <h1 class="content-title text-[24px] text-black">刪除「{{ formTitle }}」表單</h1>
          <button type="button" class="text-[28px] font-bold text-black" @click="closing()">
            <img :src="close" alt="">
          </button>
        </div>
        <div class="pt-[15px]">
          <div>
            <span></span>
            <span>刪除後無法再復原。您確定刪除此份表單嗎?</span>
          </div>
          <div class="flex justify-start mt-7">
            <button type="button"
              class="btn px-5 py-2 rounded-[10px] bg-blue text-white hover:shadow hover:shadow-gray-400" @click="submitDataId()">刪除</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style lang="scss" scoped>
#TrashCanModal {
  .container {
    @apply w-full h-screen fixed top-0 left-0 bg-[#e6e6e65a] z-20;

    .content {
      @apply w-[500px] bg-white rounded-xl border shadow-lg absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 p-6;
      @media (max-width: 550px) {
        @apply w-[90%];
      }
      .content-title {
        @media (max-width: 550px) {
          @apply text-[17px] font-semibold;
        }
      }
    }
  }
}
</style>
