<template>
    <Head title="Address Informmation" />
    <section class="grid grid-cols-2 h-[100vh] w-[100vw]">
        <div
            class="w-full bg-cover bg-center rounded-r-2xl"
            :style="{ backgroundImage: `url(${Img3})` }"
        ></div>
        <div class="py-10 px-[80px] grid grid-cols-1 content-center gap-5">
            <div>
                <h1 class="text-3xl font-bold">Address Information</h1>
                <h2 class="text-md mt-4 text-gray-400">
                    We can help with that. what is your address?
                </h2>
            </div>

            <section class="grid w-full grid-cols-2 gap-6">
                <div class="col-span-1">
                    <ui-input
                        type="text"
                        id="address"
                        name="address"
                        placeholder="Enter Street Address"
                        label="Street Address"
                        :is-required="true"
                        v-model="form.address"
                        :error="form.errors.address"
                    />
                </div>

                <div class="col-span-1">
                    <ui-input
                        type="text"
                        id="ste"
                        name="ste"
                        placeholder="-"
                        label="Ste/Apt"
                        :is-required="false"
                        v-model="form.ste"
                        :error="form.errors.ste"
                    />
                </div>

                <div class="col-span-2">
                    <ui-input
                        type="text"
                        id="city"
                        name="city"
                        placeholder="Enter City"
                        label="City"
                        :is-required="true"
                        v-model="form.city"
                        :error="form.errors.city"
                    />
                </div>

                <div class="col-span-2">
                    <ui-select
                        v-model="form.province_id"
                        label="State"
                        :is-required="true"
                        :options="provinces"
                        :error="form.errors.province_id"
                        :option-label="'Choose Your State'"
                    />
                </div>

                <div class="col-span-2">
                    <ui-input
                        type="text"
                        id="zip"
                        name="zip"
                        placeholder="Enter Zip Code"
                        label="Zip Code"
                        :is-required="true"
                        v-model="form.zip"
                        :error="form.errors.zip"
                    />
                </div>
            </section>

            <button
                @click="submit"
                class="text-white bg-blue-600 hover:bg-blue-800 font-medium rounded-lg text-md px-5 py-2.5 me-2 mb-2 justify-self-center col-span-1 w-full"
            >
                Continue
            </button>

            <Link
                href="/personal"
                class="text-blue-600 hover:text-white hover:bg-blue-600 font-medium rounded-lg text-md px-5 py-2.5 me-2 mb-2 justify-self-center col-span-1 w-full text-center"
            >
                Back
            </Link>
        </div>
    </section>
</template>

<script lang="ts" setup>
import { router, useForm, Head, Link, usePage } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import Img3 from "@/assets/img/bg-3.jpg";

import { useUserStore } from "@/stores/UserStore";

const store = useUserStore();
console.log(store.userInsurences);

const page = usePage();

const form = useForm({
    address: "",
    ste: "",
    city: "",
    province_id: "",
    zip: "",
    insurances: store.userInsurences,
    // insurances: JSON.parse(localStorage.getItem("insurances") || "[]"),
});

interface Province {
    id: number;
    name: string;
}

const props = defineProps({
    provinces: {
        type: Array as () => Province[],
        required: true,
    },
    userEmail: {
        type: String,
        required: true,
    },
});

const submit = () => {
    form.post(route("address.store", props.userEmail), {
        onFinish: () => {
            form.reset("address", "ste", "city", "province_id", "zip");
        },

        onSuccess: () => {
            // localStorage.removeItem("insurances");
            store.userInsurences = [];

            toast("Your Insurance Has Been Saved", {
                theme: toast.THEME.COLORED,
                position: "top-center",
                transition: toast.TRANSITIONS.FLIP,
                type: toast.TYPE.SUCCESS,
            });
        },
    });
};

onMounted(() => {
    if (store.userInsurences.length == 0) {
        router.visit("/", {
            method: "get",
            onSuccess: (page: any) => {
                toast("Please select an insurance", {
                    theme: toast.THEME.COLORED,
                    position: "top-center",
                    transition: toast.TRANSITIONS.FLIP,
                    type: toast.TYPE.ERROR,
                });
            },
        });
    }
});
</script>
