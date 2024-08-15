<template>
    <Head title="Personal Inforamtion" />
    <section class="grid grid-cols-2 h-[100vh] w-[100vw]">
        <div
            class="w-full bg-cover bg-center rounded-r-2xl"
            :style="{ backgroundImage: `url(${Img2})` }"
        ></div>
        <div class="py-10 px-[80px] grid grid-cols-1 content-center gap-5">
            <div>
                <h1 class="text-3xl font-bold">Personal Information</h1>
                <h2 class="text-md mt-4 text-gray-400">
                    Ok, Great! Before we continue, please let us know how we can
                    contact you regarding your quote.
                </h2>
            </div>

            <section class="grid w-full grid-cols-2 gap-6">
                <div class="col-span-1">
                    <ui-input
                        type="text"
                        id="first_name"
                        name="first_name"
                        placeholder="Enter First Name"
                        label="First Name"
                        :is-required="true"
                        v-model="form.first_name"
                        :error="form.errors.first_name"
                    />
                </div>

                <div class="col-span-1">
                    <ui-input
                        type="text"
                        id="last_name"
                        name="last_name"
                        placeholder="Enter Last Name"
                        label="Last Name"
                        :is-required="true"
                        v-model="form.last_name"
                        :error="form.errors.last_name"
                    />
                </div>

                <div class="col-span-2">
                    <ui-input
                        type="text"
                        id="email"
                        name="email"
                        placeholder="Enter Email Address"
                        label="Email Address"
                        :is-required="true"
                        v-model="form.email"
                        :error="form.errors.email"
                    />
                </div>

                <div class="col-span-2">
                    <ui-input
                        type="text"
                        id="phone"
                        name="phone"
                        placeholder="Enter Phone No"
                        label="Phone No"
                        :is-required="true"
                        v-model="form.phone"
                        :error="form.errors.phone"
                    />
                </div>

                <div class="col-span-2">
                    <ui-select
                        v-model="form.contact_type"
                        label="Contact Preference"
                        :is-required="true"
                        :options="prefrences"
                        :error="form.errors.contact_type"
                        :option-label="'Choose a contact preference'"
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
                href="/"
                class="text-blue-600 hover:text-white hover:bg-blue-600 font-medium rounded-lg text-md px-5 py-2.5 me-2 mb-2 justify-self-center col-span-1 w-full text-center"
            >
                Back
            </Link>
        </div>
    </section>
</template>

<script lang="ts" setup>
import { router, useForm, Head, Link } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import Img2 from "@/assets/img/bg-2.jpg";

import { useUserStore } from "@/stores/UserStore";

const store = useUserStore();

const form = useForm({
    first_name: "",
    last_name: "",
    email: "",
    phone: "",
    contact_type: "",
});

const prefrences = [
    { id: 0, name: "Email" },
    { id: 1, name: "Phone" },
];

const submit = () => {
    form.post(route("personal.store"), {
        onFinish: () => {
            form.reset(
                "first_name",
                "last_name",
                "email",
                "phone",
                "contact_type"
            );
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
