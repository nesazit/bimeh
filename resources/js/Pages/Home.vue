<template>
    <Head title="Home" />
    <section class="grid grid-cols-2 h-[100vh] w-[100vw]">
        <div
            class="w-full bg-cover bg-center rounded-r-2xl"
            :style="{ backgroundImage: `url(${Img1})` }"
        ></div>
        <div
            class="py-10 px-[80px] grid grid-cols-1 justify-items-center content-center gap-5"
        >
            <div>
                <h1 class="text-3xl font-bold">Let's get started</h1>
                <h2 class="text-md mt-4 text-gray-400">
                    Please select one or more options below that you'd like to
                    have qouted for insurance.
                </h2>
            </div>

            <section class="grid w-full grid-cols-1 gap-6">
                <div v-for="(item, index) in insurances" :key="index">
                    <input
                        type="checkbox"
                        :id="`insurance${index}`"
                        value=""
                        class="hidden peer"
                        :checked="store.userInsurences.includes(item.id)"
                    />
                    <label
                        @click="handleSelectInsurance(item.id)"
                        :style="{
                            backgroundImage: `linear-gradient(90deg, rgba(0, 0, 0, 0.85) 0%, rgba(33, 33, 33, 0.3) 100%), url(${item.image})`,
                        }"
                        :for="`insurance${index}`"
                        :class="
                            store.userInsurences.includes(item.id)
                                ? ' border-blue-600 '
                                : ' border-gray-200 '
                        "
                        class="inline-flex items-center text-white justify-between w-full p-5 bg-white bg-center bg-cover border-2 rounded-2xl cursor-pointer hover:text-blue-300 hover:border-blue-500 hover:bg-gray-50 relative"
                    >
                        <div
                            class="right-0 top-0 bg-blue-600 rounded-tr-xl rounded-bl-xl p-2"
                            :class="
                                store.userInsurences.includes(item.id)
                                    ? ' absolute '
                                    : ' hidden '
                            "
                        >
                            <Icon icon="mdi:tick" class="text-white" />
                        </div>
                        <div class="flex justify-between items-center gap-2">
                            <div
                                class="p-4 rounded-lg text-center flex items-center bg-white w-[65px] h-[65px]"
                            >
                                <Icon
                                    :icon="item.icon"
                                    height="60"
                                    width="60"
                                    class="text-blue-600"
                                />
                            </div>
                            <div>
                                <div class="w-full text-lg font-semibold">
                                    {{ item?.title }}
                                </div>
                                <div class="w-full text-sm">
                                    {{ item?.description }}
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
            </section>

            <button
                @click="handleSubmit"
                class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-md px-5 py-2.5 me-2 mb-2 justify-self-center col-span-1 w-full"
            >
                Agree and Continue
            </button>

            <p class="text-gray-400">
                By continunig this form you agree to share data with Franke
                Insurance Services as defined in the Terms of Use and Privacy
                Policy.
            </p>
        </div>
    </section>
</template>

<script lang="ts" setup>
import { router, Head } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import Img1 from "@/assets/img/bg-1.jpg";

import { useUserStore } from "@/stores/UserStore";

const store = useUserStore();
interface Insurance {
    id: number;
    title: string;
    description: string;
    icon: string;
    image: string;
    price: number;
    duration: number;
}

const handleSelectInsurance = (insuranceId: number) => {
    store.selectInsurance(insuranceId);
};

const handleSubmit = () => {
    if (store.userInsurences.length > 0) {
        // localStorage.setItem(
        //     "insurances",
        //     JSON.stringify(store.userInsurences)
        // );
        router.visit("/personal", {
            method: "get",
        });
    } else {
        toast("Please select an insurance", {
            theme: toast.THEME.COLORED,
            position: "top-center",
            transition: toast.TRANSITIONS.FLIP,
            type: toast.TYPE.ERROR,
            //   toastStyle: {
            //     fontFamily: "font-primary",
            //   },
        });
    }
};

const props = defineProps<{
    insurances?: Insurance[];
}>();
</script>
