<script>
import close from '/images/close.svg';
import Swal from 'sweetalert2';
import { router } from '@inertiajs/vue3';

export default {
  props: {
    errors: Object,
    formUrl: String,
    coFormId: String,
  },
  emits: [
    'closeModel',
  ],
  data() {
    return {
      close,
      newFormName: '',
      sameCallaborator: '',
    };
  },
  mounted() {

  },
  methods: {
    closing() {
      this.$emit('closeModel');
    },
    addSameForm() {
    //   Swal.fire('hihi');
      this.closing();
      const sameFormId = parseInt(this.coFormId, 10);
      const { newFormName, sameCallaborator } = this;

      router.visit(route('edit.addSameForm'), {
        method: 'post', data: { sameFormId, newFormName, sameCallaborator }, preserveState: true,
        onSuccess: ({ props }) => {
          if (props.flash.message.rt_code === 1) {
            Swal.fire({
              title: '已新增副本',
              showDenyButton: false,
              confirmButtonText: '確定',
              denyButtonText: '',
            });
          }
        },
      });
    },
  },
};
</script>

<template>
  <section id="CopyDocumentModal">
    <div class="container">
      <div class="content">
        <div class="flex justify-between items-center">
          <h1 class="text-[24px] text-black">複製文件</h1>
          <button type="button" class="text-[28px] font-bold text-black" @click="closing()">
            <img :src="close" alt="">
          </button>
        </div>
        <div class="pt-[15px]">
          <div>
            <div class="flex flex-col mb-5">
              <label for="name">名稱</label><span v-if="$page.props.errors.newFormName" class="text-red">{{ $page.props.errors.newFormName }}</span>
              <input v-model="newFormName" type="text" class="h-[30px] text-gray-400 text-lg" id="name" :class="{ 'border-[red]': $page.props.errors.newFormName }">
            </div>
            <div class="flex items-center gap-2">
              <input v-model="sameCallaborator" type="checkbox" id="collaborator">
              <label for="collaborator" class="text-[14px]">與同樣的協作者共用</label>
            </div>
          </div>
          <div class="flex justify-start mt-7">
            <button type="button" class="btn px-5 py-2 border border-grey-light bg-grey-middle hover:bg-blue-light hover:shadow rounded-[10px] mr-3"
              @click="closing()">取消</button>
            <button type="button"
              class="btn px-5 py-2 rounded-[10px] bg-blue text-white hover:shadow hover:shadow-gray-400" @click="addSameForm()">建立副本</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style lang="scss" scoped>
#CopyDocumentModal {
  .container {
    @apply w-full h-screen fixed top-0 left-0 bg-[#e6e6e65a] z-20;
    .content {
      @apply w-[500px] h-[300px] bg-white rounded-xl border shadow-lg absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 p-6;
      @media (max-width: 550px) {
        @apply w-[90%];
      }
    }
  }
}
</style>
