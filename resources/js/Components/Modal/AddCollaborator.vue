<script>
import close from '/images/close.svg';
import link from '/images/link.svg';
import { router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

export default {
  props: {
    coFormId: String,
  },
  emits: [
    'closeModel',
  ],
  data() {
    return {
      images: {
        close,
        link,
      },
      co_email: '',
      coformemail: [],
      formOwner: {},
    };
  },
  mounted() {
    this.getCoworker();
  },
  methods: {
    getCoworker() {
      const { coFormId } = this;
      router.visit(route('coformid.index'), {
        method: 'get', data: { coFormId }, preserveState: true,
        onSuccess: ({ props }) => {
          this.formOwner = props.flash.message.rt_data[1];
          this.coformemail = props.flash.message.rt_data[0];
        },
      });
    },
    closing() {
      // this.show = false;
      this.$emit('closeModel');
    },
    submitDataId() {
      const { co_email } = this;
      const coFormIdNumber = parseInt(this.coFormId, 10);
      router.visit(route('coformid.store'), {
        method: 'post', data: { co_email, coFormIdNumber }, preserveState: true,
        onSuccess: ({ props }) => {
          if (props.flash.message.rt_code === 1) {
            Swal.fire({
              title: '新增成功',
              showDenyButton: true,
              confirmButtonText: '回列表',
              denyButtonText: '取消',
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
  <section id="AddCollaborator">
    <div class="container">
      <form @submit.prevent="submitDataId()">
        <div class="content">
          <div class="flex justify-between items-center px-8">
            <h1 class="text-[18px] text-black">將編輯者新增至<span>「未命名表單」</span></h1>
            <button type="button" class="text-[28px] font-bold text-black" @click="closing()">
              <img :src="images.close" alt="">
            </button>
          </div>
          <div class="pt-[15px]">
            <div class="flex flex-col gap-4">
              <div class="px-8 flex flex-col gap-4">
                <input v-model="co_email" type="email" class="w-full h-[45px] rounded-md text-[14px]"
                  placeholder="新增使用者和群組">
                <p>具有存取權的使用者</p>
              </div>
              <div class="flex items-center gap-3 hover:bg-grey-light px-8 w-full">
                <div class="rounded-full bg-purple w-[22px] h-[22px]"></div>
                <div class="flex flex-col">
                  <span class="text-[12px]">{{ formOwner.name }}</span>
                  <span class="text-[12px] text-[#6e6e6e]">{{ formOwner.email }}</span>
                </div>
                <span class="w-[60%] text-[14px] text-grey flex justify-end">擁有者</span>
              </div>
              <!-- {{ props.flash.message.rt_dataquestion }} -->
              <div v-for="item in coformemail" :key="item.id" class="flex items-center gap-3 hover:bg-grey-light px-8 w-full">
                <div class="rounded-full bg-purple w-[22px] h-[22px]"></div>
                <div class="flex flex-col">
                  <span class="text-[12px]">{{ item.user.name }}</span>
                  <span class="text-[12px] text-[#6e6e6e]">{{ item.user.email }}</span>
                </div>
                <span class="w-[60%] text-[14px] text-grey flex justify-end">編輯者</span>
              </div>
            </div>
            <div class="flex justify-end mt-7 px-8">
              <button type="submit"
                class="btn px-5 py-2 rounded-[45px] bg-blue text-white hover:shadow hover:shadow-gray-400">完成</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
</template>

<style lang="scss" scoped>
#AddCollaborator {
  .container {
    @apply w-full h-screen fixed top-0 left-0 bg-[#e6e6e65a] z-20;

    .content {
      @apply w-[500px] bg-white rounded-xl border shadow-lg absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 py-8;
    }
  }
}
</style>
