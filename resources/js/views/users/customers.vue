<script>
import Layout from "../../layouts/main.vue";
// import appConfig from "@/app.config";
// import PageHeader from "@/components/page-header";
import axios from "axios";
import Swal from "sweetalert2";
// import JsonExcel from "vue-json-excel3";
import FsLightbox from "fslightbox-vue/v3";
// import {toUpperCase} from "uri-js/dist/esnext/util";


/**
 * Dashboard Component
 */
export default {
    page: {
        title: "Data Customer",
        meta: [
            {
                name: "description",
                // content: appConfig.description,
            },
        ],
    },
    components: {
        Layout,
        // downloadExcel: JsonExcel,
        // PageHeader,
        FsLightbox,
    },
    data() {
        return {
            modalAdd: false,
            modalEdit: false,
            modalDetail: false,
            modalUpload_Ktp: false,
            customers: [],
            toggler: false,
            sources: '',
            title: "Data Customer",
            items: [
                {
                    text: "Data Customers",
                    href: "/",
                },
                {
                    text: "Default",
                    active: true,
                },
            ],
            columns: [
                {
                    label: "Nomor Identitas",
                    field: "customer.nomor_identitas",
                    filterOptions: {
                        styleClass: "class1",
                        enabled: true,
                        placeholder: "Cari berdasarkan Nomor Identitas...",
                        filterValue: "",
                    },
                },
                {
                    label: "Username",
                    field: "username",
                    hidden: true,
                    filterOptions: {
                        styleClass: "class1",
                        enabled: true,
                        placeholder: "Cari berdasarkan Username...",
                        filterValue: "",
                    },
                },
                {
                    label: "Email",
                    field: "customer.email",
                    hidden: true,
                    filterOptions: {
                        styleClass: "class1",
                        enabled: true,
                        placeholder: "Cari berdasarkan Email...",
                        filterValue: "",
                    },
                },
                {
                    label: "Nama",
                    field: "name",
                    filterOptions: {
                        styleClass: "class1",
                        enabled: true,
                        placeholder: "Cari berdasarkan Nama...",
                        filterValue: "",
                    },
                },
                {
                    label: "Alamat",
                    field: "customer.address",
                    filterOptions: {
                        styleClass: "class1",
                        enabled: true,
                        placeholder: "Cari berdasarkan...",
                        filterValue: "",
                    },
                },
                {
                    label: "Nomor Telepon",
                    field: "customer.phone",
                    filterOptions: {
                        styleClass: "class1",
                        enabled: true,
                        placeholder: "Cari berdasarkan...",
                        filterValue: "",
                    },
                },
                {
                    label: "Role",
                    field: "role",
                    hidden: true,
                    filterOptions: {
                        styleClass: "class1",
                        enabled: true,
                        placeholder: "Cari berdasarkan...",
                        filterValue: "",
                    },
                },
                {
                    label: "Foto KTP",
                    field: "customer.foto_identitas",

                },
                {
                    label: "Limit Piutang",
                    field: "customer.limit_pinjaman",
                    filterOptions: {
                        styleClass: "class1",
                        enabled: true,
                        placeholder: "Cari berdasarkan...",
                        filterValue: "",
                    },
                },
                {
                    label: "Actions",
                    field: "actions",
                },
            ],
            form: {
                id: null,
                name: "",
                username: "",
                password: "",
                nomor_identitas: "",
                phone: "",
                email: "",
                address: "",
                limit_pinjaman: "",
                foto_identitas: "",
                role: "",
            },
            selectedFile: false,
            loading: false,
            saving: false,
            errors: [],
            export_fields: {
                name: "name",
                username: "username",
                nomor_identitas: "customer.nomor_identitas",
                phone: "customer.phone",
                email: "customer.email",
                address: "customer.address",
                role: "role",
                foto_identitas: "customer.foto_identitas",
                limit_pinjaman: "customer.limit_pinjaman",
            },
            roles: [
                {value: "customer", text: "Customer"},
            ],
            identity_type: [
                {value: "ktp", text: "KTP"},
            ]
        };
    },

    methods: {
        // toUpperCase,
        async getCustomers() {
            try {
                this.loading = true;
                const response = await axios.get(`/api/user/customer`);
                console.log(response)
                this.customers = response.data.data;
                this.loading = false;
            } catch (error) {
                this.loading = false;
            }
        },
        async saveData() {
            try {
                this.saving = true;

                let url ="/api/user/customer";

                let formData = new FormData();

                formData.append("identitas_type", 'KTP');

                if (this.form.name !== null) formData.append("name", this.form.name);
                if (this.form.username !== null) formData.append("username", this.form.username);
                if (this.form.password !== null) formData.append("password", this.form.password);
                if (this.form.email !== null) formData.append("email", this.form.email);
                if (this.form.nomor_identitas !== null) formData.append("nomor_identitas", this.form.nomor_identitas);
                if (this.form.phone !== null) formData.append("phone", this.form.phone);
                if (this.form.address !== null) formData.append("address", this.form.address);
                if (this.form.limit_pinjaman !== null) formData.append("limit_pinjaman", this.unFormatInputRupiah(this.form.limit_pinjaman ?? 0));
                if (this.form.role !== null) formData.append("role", this.form.role);

                if (this.form.id !== null) {
                    formData.append("id", this.form.id);
                    formData.append("_method", "put");
                }

                try {
                    // Attempt to make the POST request
                    await axios.post(url, formData);

                    // If successful, show success message
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Success Save Data",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                } catch (error) {
                    // If an error occurs, handle it and show an error message
                    if (error.response) {
                        // The request was made and the server responded with a status code
                        // that falls out of the range of 2xx
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: `${error.response.data.message}`,
                        });
                    } else if (error.request) {
                        // The request was made but no response was received
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "No response received from the server",
                        });
                    } else {
                        // Something happened in setting up the request that triggered an Error
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "An unexpected error occurred",
                        });
                    }
                }

                this.saving = false;
                this.modalAdd = false;
                this.modalEdit = false;

                this.getCustomers();
            } catch (error) {
                this.saving = false;
                this.errors = error.response.data.errors;

                console.log(error);
            }
        },
        async uploadKtp() {
            try {
                this.saving = true;

                const mainUrl = "/api/user/customer/uploadIdentitas/" + this.form.id;
                let url = mainUrl;

                let formData = new FormData();
                formData.append("foto_identitas", this.selectedFile);

                try {
                    // Attempt to make the POST request
                    await axios.post(url, formData);

                    // If successful, show success message
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Success Save Data",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                } catch (error) {
                    // If an error occurs, handle it and show an error message
                    if (error.response) {
                        // The request was made and the server responded with a status code
                        // that falls out of the range of 2xx
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: `Error : ${error.response.status}`,
                        });
                    } else if (error.request) {
                        // The request was made but no response was received
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "No response received from the server",
                        });
                    } else {
                        // Something happened in setting up the request that triggered an Error
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "An unexpected error occurred",
                        });
                    }
                }

                this.saving = false;
                this.modalAdd = false;
                this.modalEdit = false;

                this.getCustomers();
            } catch (error) {
                this.saving = false;
                this.errors = error.response.data.errors;

                console.log(error);
            }
        },
        setForm(data, type) {
            this.form = {
                id: data.id,
                name: data.name,
                username: data.username,
                email: data.customer.email,
                password: null,
                limit_pinjaman: data.customer.limit_pinjaman,
                nomor_identitas: data.customer.nomor_identitas,
                foto_identitas: data.customer.foto_identitas,
                identitas_type: data.customer.identitas_type,
                phone: data.customer.phone,
                address: data.customer.address,
                role: data.role,
            };

            switch (type) {
                case "edit":
                    this.$refs.rupiahInput.$el.value = this.form.limit_pinjaman ?? 0;
                    this.formatInput()
                    this.modalEdit = !this.modalEdit;
                    break;
                case "detail":
                    this.modalDetail = !this.modalDetail;
                    break;
                case "upload_ktp":
                    this.modalUpload_Ktp = !this.modalUpload_Ktp;
                    break;
                default:
                    break;
            }
        },
        handleFileChange() {
            this.selectedFile = this.$refs.fileInput.files[0];
        },
        deleteData(id) {
            Swal.fire({
                title: "Confirm",
                text: "Apakah anda yakin ingin menghapus data ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Hapus!",
            }).then(async (result) => {
                try {
                    if (result.value) {

                        let formData = new FormData();
                        formData.append("id", id);
                        formData.append("_method", "delete");

                        const response = await axios.delete(`/api/user/customer/`, formData);
                        Swal.fire("Deleted!", response.data.messages, "success");
                        this.getCustomers();
                    }
                } catch (error) {
                    // Handle errors and show an error message
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "An error occurred while deleting data",
                    });
                    console.error("Error deleting data:", error);
                }
            });
        },
        lightBoxImages(img) {
            this.toggler = !this.toggler;
            // console.log(img)
            this.sources = [img]
            console.log(this.sources)
        },
        formatInput() {
            const inputValue = this.$refs.rupiahInput.$el.value;

            const formattedValue = this.formatInputRupiah(inputValue, 'Rp. ');
            this.form.limit_pinjaman = formattedValue
            this.$refs.rupiahInput.$el.value = formattedValue;
        },
        unFormatInputRupiah(angka) {
            // Remove any non-digit characters from the input string
            const unformattedValue = angka.replace(/[^0-9]/g, '');
            return unformattedValue;
        },
        formatInputRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                const separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix === undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        },
        formatToRupiah(amount) {
            return new Intl.NumberFormat('id-ID', {
                maximumFractionDigits: 0,
                style: 'currency',
                currency: 'IDR',
            }).format(amount);
        },
        generateFilename(prefix) {
            const now = new Date();
            const formattedDate = now.toISOString().slice(0, 10).replace(/-/g, ''); // Format: YYYYMMDD
            const formattedTime = now.toLocaleTimeString().replace(/:/g, ''); // Format: HHMMSS
            return `${prefix}-${formattedDate}-${formattedTime}.xls`;
        },
    },


    watch: {
        modalAdd: {
            handler(val) {
                if (!val) {
                    this.form = {
                        id: null,
                        name: "",
                        username: "",
                        password: "",
                        email: "",
                        identitas_type: "",
                        nomor_identitas: "",
                        foto_identitas: "",
                        phone: "",
                        address: "",
                        role: "",
                    };
                    this.errors = [];
                    this.selectedFile = '';
                    this.$refs.rupiahInput.$el.value = '';
                }
            },
        },
        modalEdit: {
            handler(val) {
                if (!val) {
                    this.form = {
                        id: null,
                        name: "",
                        username: "",
                        password: "",
                        email: "",
                        identitas_type: "",
                        foto_identitas: "",
                        nomor_identitas: "",
                        phone: "",
                        address: "",
                        role: "",
                    };
                    this.errors = [];
                    this.selectedFile = '';
                    this.$refs.rupiahInput.$el.value = '';
                }
            },
        },
        modalUpload_Ktp: {
            handler(val) {
                if (!val) {
                    this.form = {
                        id: null,
                        foto: "",
                    };
                    this.errors = [];
                    this.selectedFile = '';
                    this.$refs.fileInput.value = null;
                    this.$refs.rupiahInput.$el.value = '';
                }
            },
        },
    },

    mounted() {
        this.getCustomers();
    },
};
</script>

<template>
    <Layout>
        <PageHeader :items="items" :title="title"/>

        <b-card
            style="margin-top: -20px"
            sub-title="Card subtitle"
            title="Data User Customer"
        >
            <BModal v-model="modalAdd" hide-footer="true" hide-header="true">
                <div class="card overflow-hidden">
                    <div class="bg-soft bg-primary">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">Tambah User Customer</h5>
                                    <p>Buat akun anda</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img
                                    alt
                                    class="img-fluid"
                                    src="@/assets/images/logo_zaj.png"
                                    width="150"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div>
                            <router-link to="/">
                                <div class="avatar-md profile-user-wid mb-4">
                  <span class="avatar-title rounded-circle bg-light">
                    <img
                        alt
                        class="rounded-circle"
                        height="34"
                        src="@/assets/images/logo.svg"
                    />
                  </span>
                                </div>
                            </router-link>
                        </div>
                        <b-form class="p-2">
                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Nama"
                                label-for="name"
                            >
                                <b-form-input
                                    id="username"
                                    v-model="form.name"
                                    :class="{
                    'is-invalid': submitted && v$.user.name.$error,
                  }"
                                    placeholder="Masukkan Nama"
                                    type="text"
                                ></b-form-input>
                                <BAlert
                                    v-if="errors['name']"
                                    :model-value="true"
                                    class="mt-2"
                                    variant="danger"
                                >{{ errors["name"][0] }}
                                </BAlert
                                >
                            </b-form-group>

                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Username"
                                label-for="username"
                            >
                                <b-form-input
                                    id="username"
                                    v-model="form.username"
                                    :class="{
                    'is-invalid': submitted && v$.user.name.$error,
                  }"
                                    placeholder="Masukkan Username"
                                    type="text"
                                ></b-form-input>
                                <BAlert
                                    v-if="errors['username']"
                                    :model-value="true"
                                    class="mt-2"
                                    variant="danger"
                                >{{ errors["username"][0] }}
                                </BAlert
                                >
                            </b-form-group>

                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Email"
                                label-for="email"
                            >
                                <b-form-input
                                    id="email"
                                    v-model="form.email"
                                    :class="{
                    'is-invalid': submitted && v$.user.name.$error,
                  }"
                                    placeholder="Masukkan email"
                                    type="email"
                                ></b-form-input>
                                <BAlert
                                    v-if="errors['email']"
                                    :model-value="true"
                                    class="mt-2"
                                    variant="danger"
                                >{{ errors["email"][0] }}
                                </BAlert
                                >
                            </b-form-group>

                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Password"
                                label-for="password"
                            >
                                <b-form-input
                                    id="password"
                                    v-model="form.password"
                                    :class="{
                    'is-invalid': submitted && v$.user.address.$error,
                  }"
                                    placeholder="Input Password"
                                    type="password"
                                ></b-form-input>
                                <BAlert
                                    v-if="errors['password']"
                                    :model-value="true"
                                    class="mt-2"
                                    variant="danger"
                                >{{ errors["password"][0] }}
                                </BAlert
                                >
                            </b-form-group>

                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Nomor Identitas"
                                label-for="nomor_identitas"
                            >
                                <b-form-input
                                    id="nomor_identitas"
                                    v-model="form.nomor_identitas"
                                    :class="{
                    'is-invalid': submitted && v$.user.address.$error,
                  }"
                                    placeholder="Input Nomor Identitas"
                                    type="nomor_identitas"
                                ></b-form-input>
                                <BAlert
                                    v-if="errors['nomor_identitas']"
                                    :model-value="true"
                                    class="mt-2"
                                    variant="danger"
                                >{{ errors["nomor_identitas"][0] }}
                                </BAlert
                                >
                            </b-form-group>

                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Nomor Telepon"
                                label-for="phone"
                            >
                                <b-form-input
                                    id="phone"
                                    v-model="form.phone"
                                    :class="{
                    'is-invalid': submitted && v$.user.address.$error,
                  }"
                                    placeholder="Input Nomor Telepon"
                                    type="phone"
                                ></b-form-input>
                                <BAlert
                                    v-if="errors['phone']"
                                    :model-value="true"
                                    class="mt-2"
                                    variant="danger"
                                >{{ errors["phone"][0] }}
                                </BAlert
                                >
                            </b-form-group>

                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Alamat"
                                label-for="address"
                            >
                                <b-form-input
                                    id="address"
                                    v-model="form.address"
                                    :class="{
                    'is-invalid': submitted && v$.user.address.$error,
                  }"
                                    placeholder="Input Alamat"
                                    type="address"
                                ></b-form-input>
                                <BAlert
                                    v-if="errors['address']"
                                    :model-value="true"
                                    class="mt-2"
                                    variant="danger"
                                >{{ errors["address"][0] }}
                                </BAlert
                                >
                            </b-form-group>

                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Limit Pinjamans"
                                label-for="limit_injaman"
                            >
                                <b-form-input
                                    id="limit_injaman"
                                    ref="rupiahInput"
                                    :class="{
                    'is-invalid': submitted && v$.user.address.$error,
                  }"
                                    placeholder="Input Limit Pinjaman"
                                    type="text"
                                    @input="formatInput"
                                ></b-form-input>
                                <BAlert
                                    v-if="errors['limit_pinjaman']"
                                    :model-value="true"
                                    class="mt-2"
                                    variant="danger"
                                >{{ errors["limit_pinjaman"][0] }}
                                </BAlert
                                >
                            </b-form-group>

                            <!--              <b-form-group-->
                            <!--                class="mb-3"-->
                            <!--                id="email-group"-->
                            <!--                label="Tipe Identitas"-->
                            <!--                label-for="identity_type"-->
                            <!--              >-->
                            <!--                <BFormSelect v-model="form.identitas_type" :options="identity_type" />-->
                            <!--                <BAlert-->
                            <!--                  :model-value="true"-->
                            <!--                  v-if="errors['identitas_type']"-->
                            <!--                  variant="danger"-->
                            <!--                  class="mt-2"-->
                            <!--                  >{{ errors["identitas_type"][0] }}</BAlert-->
                            <!--                >-->
                            <!--              </b-form-group>-->

                            <!--              <b-form-group-->
                            <!--                class="mb-3"-->
                            <!--                id="email-group"-->
                            <!--                label="Foto KTP"-->
                            <!--                label-for="foto_ktp"-->
                            <!--              >-->
                            <!--                <b-form-input-->
                            <!--                  id="foto_ktp"-->
                            <!--                  type="file"-->
                            <!--                  v-model="form.foto_ktp"-->
                            <!--                  placeholder="Input Foto KTP"-->
                            <!--                  :class="{-->
                            <!--                    'is-invalid': submitted && v$.user.address.$error,-->
                            <!--                  }"-->
                            <!--                ></b-form-input>-->
                            <!--                <BAlert-->
                            <!--                  :model-value="true"-->
                            <!--                  v-if="errors['foto_ktp']"-->
                            <!--                  variant="danger"-->
                            <!--                  class="mt-2"-->
                            <!--                  >{{ errors["foto_ktp"][0] }}</BAlert-->
                            <!--                >-->
                            <!--              </b-form-group>-->

                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Role"
                                label-for="role"
                            >
                                <BFormSelect v-model="form.role" :options="roles"/>
                                <BAlert
                                    v-if="errors['role']"
                                    :model-value="true"
                                    class="mt-2"
                                    variant="danger"
                                >{{ errors["role"][0] }}
                                </BAlert
                                >
                            </b-form-group>

                            <div class="mt-4 d-grid">
                                <BButton :disabled="saving" variant="primary" @click="saveData">
                                    <span class="mx-3">Save</span>
                                    <BSpinner v-if="saving" small/>
                                </BButton>
                            </div>
                        </b-form>
                    </div>
                    <!-- end card-body -->
                </div>
            </BModal>
            <BModal v-model="modalEdit" hide-footer="true" hide-header="true">
                <div class="card overflow-hidden">
                    <div class="bg-soft bg-primary">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">Edit Customer</h5>
                                    <p>Edit akun anda</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img
                                    alt
                                    class="img-fluid"
                                    src="@/assets/images/logo_zaj.png"
                                    width="150"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div>
                            <router-link to="/">
                                <div class="avatar-md profile-user-wid mb-4">
                  <span class="avatar-title rounded-circle bg-light">
                    <img
                        alt
                        class="rounded-circle"
                        height="34"
                        src="@/assets/images/logo.svg"
                    />
                  </span>
                                </div>
                            </router-link>
                        </div>

                        <b-form class="p-2">
                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Nama"
                                label-for="name"
                            >
                                <b-form-input
                                    id="username"
                                    v-model="form.name"
                                    :class="{
                    'is-invalid': submitted && v$.user.name.$error,
                  }"
                                    placeholder="Masukkan Nama"
                                    type="text"
                                ></b-form-input>
                                <BAlert
                                    v-if="errors['name']"
                                    :model-value="true"
                                    class="mt-2"
                                    variant="danger"
                                >{{ errors["name"][0] }}
                                </BAlert
                                >
                            </b-form-group>

                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Username"
                                label-for="username"
                            >
                                <b-form-input
                                    id="username"
                                    v-model="form.username"
                                    :class="{
                    'is-invalid': submitted && v$.user.name.$error,
                  }"
                                    placeholder="Masukkan Username"
                                    type="text"
                                ></b-form-input>
                                <BAlert
                                    v-if="errors['username']"
                                    :model-value="true"
                                    class="mt-2"
                                    variant="danger"
                                >{{ errors["username"][0] }}
                                </BAlert
                                >
                            </b-form-group>

                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Email"
                                label-for="email"
                            >
                                <b-form-input
                                    id="email"
                                    v-model="form.email"
                                    :class="{
                    'is-invalid': submitted && v$.user.name.$error,
                  }"
                                    placeholder="Masukkan email"
                                    type="email"
                                ></b-form-input>
                                <BAlert
                                    v-if="errors['email']"
                                    :model-value="true"
                                    class="mt-2"
                                    variant="danger"
                                >{{ errors["email"][0] }}
                                </BAlert
                                >
                            </b-form-group>

                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Password"
                                label-for="password"
                            >
                                <b-form-input
                                    id="password"
                                    v-model="form.password"
                                    :class="{
                    'is-invalid': submitted && v$.user.address.$error,
                  }"
                                    placeholder="Input Password"
                                    type="password"
                                ></b-form-input>
                                <BAlert
                                    v-if="errors['password']"
                                    :model-value="true"
                                    class="mt-2"
                                    variant="danger"
                                >{{ errors["password"][0] }}
                                </BAlert
                                >
                            </b-form-group>

                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Nomor Identitas"
                                label-for="nomor_identitas"
                            >
                                <b-form-input
                                    id="nomor_identitas"
                                    v-model="form.nomor_identitas"
                                    :class="{
                    'is-invalid': submitted && v$.user.address.$error,
                  }"
                                    placeholder="Input Nomor Identitas"
                                    type="nomor_identitas"
                                ></b-form-input>
                                <BAlert
                                    v-if="errors['nomor_identitas']"
                                    :model-value="true"
                                    class="mt-2"
                                    variant="danger"
                                >{{ errors["nomor_identitas"][0] }}
                                </BAlert
                                >
                            </b-form-group>

                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Nomor Telepon"
                                label-for="phone"
                            >
                                <b-form-input
                                    id="phone"
                                    v-model="form.phone"
                                    :class="{
                    'is-invalid': submitted && v$.user.address.$error,
                  }"
                                    placeholder="Input Nomor Telepon"
                                    type="phone"
                                ></b-form-input>
                                <BAlert
                                    v-if="errors['phone']"
                                    :model-value="true"
                                    class="mt-2"
                                    variant="danger"
                                >{{ errors["phone"][0] }}
                                </BAlert
                                >
                            </b-form-group>

                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Alamat"
                                label-for="address"
                            >
                                <b-form-input
                                    id="address"
                                    v-model="form.address"
                                    :class="{
                    'is-invalid': submitted && v$.user.address.$error,
                  }"
                                    placeholder="Input Alamat"
                                    type="address"
                                ></b-form-input>
                                <BAlert
                                    v-if="errors['address']"
                                    :model-value="true"
                                    class="mt-2"
                                    variant="danger"
                                >{{ errors["address"][0] }}
                                </BAlert
                                >
                            </b-form-group>

                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Limit Pinjaman"
                                label-for="limit_injaman"
                            >
                                <b-form-input
                                    id="limit_injaman"
                                    ref="rupiahInput"
                                    :class="{
                    'is-invalid': submitted && v$.user.address.$error,
                  }"
                                    placeholder="Input Limit Pinjaman"
                                    type="text"
                                    @input="formatInput"
                                ></b-form-input>
                                <BAlert
                                    v-if="errors['limit_pinjaman']"
                                    :model-value="true"
                                    class="mt-2"
                                    variant="danger"
                                >{{ errors["limit_pinjaman"][0] }}
                                </BAlert
                                >
                            </b-form-group>
                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Role"
                                label-for="role"
                            >
                                <BFormSelect v-model="form.role" :options="roles"/>
                                <BAlert
                                    v-if="errors['role']"
                                    :model-value="true"
                                    class="mt-2"
                                    variant="danger"
                                >{{ errors["role"][0] }}
                                </BAlert
                                >
                            </b-form-group>

                            <div class="mt-4 d-grid">
                                <BButton :disabled="saving" variant="primary" @click="saveData">
                                    <span class="mx-3">Save</span>
                                    <BSpinner v-if="saving" small/>
                                </BButton>
                            </div>
                        </b-form>
                    </div>
                    <!-- end card-body -->
                </div>
            </BModal>
            <BModal v-model="modalDetail" hide-footer="true" hide-header="true">
                <div class="card overflow-hidden">
                    <div class="bg-soft bg-primary">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">Detail Customer ( {{ form.name }} )</h5>
                                    <p>Detail</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img
                                    alt
                                    class="img-fluid"
                                    src="@/assets/images/logo_zaj.png"
                                    width="150"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div>
                            <router-link to="/">
                                <div class="avatar-md profile-user-wid mb-4">
                  <span class="avatar-title rounded-circle bg-light">
                    <img
                        alt
                        class="rounded-circle"
                        height="34"
                        src="@/assets/images/logo.svg"
                    />
                  </span>
                                </div>
                            </router-link>
                        </div>

                        <b-form class="p-2">
                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Nama"
                                label-for="name"
                            >
                                <div class="m-2">
                                    <p>{{ form.name }}</p>
                                </div>
                            </b-form-group>

                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Username"
                                label-for="username"
                            >
                                <div class="m-2">
                                    <p>{{ form.username }}</p>
                                </div>
                            </b-form-group>

                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Tipe Identitas"
                                label-for="identitas_type"
                            >
                                <div class="m-2">
                                    <p>{{ form.identitas_type }}</p>
                                </div>
                            </b-form-group>

                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Nomor Identitas"
                                label-for="nomor_identitas"
                            >
                                <div class="m-2">
                                    <p>{{ form.nomor_identitas }}</p>
                                </div>
                            </b-form-group>

                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Foto Identitas"
                                label-for=""
                            >
                                <div v-if="form.foto_identitas != null  " class="m-2">
                                    <img :src="form.foto_identitas" alt="" width="200"
                                         @click="lightBoxImages(form.foto_identitas)">
                                    <br> <br>
                                    <b-button size="sm" @click="lightBoxImages(form.foto_identitas)">Lihat Foto
                                    </b-button>
                                </div>
                                <div v-else class="m-2">
                                    <p>Tidak Ada Data</p>
                                </div>
                            </b-form-group>
                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="No Telepon"
                                label-for="phone"
                            >
                                <div class="m-2">
                                    <p>{{ form.phone }}</p>
                                </div>
                            </b-form-group>

                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Alamat"
                                label-for="address"
                            >
                                <div class="m-2">
                                    <p>{{ form.address }}</p>
                                </div>
                            </b-form-group>

                            <b-form-group
                                id="email-group"
                                class="mb-3"
                                label="Limit Piutang"
                                label-for="address"
                            >
                                <div class="m-2">
                                    <p>{{ formatToRupiah(form.limit_pinjaman) }}</p>
                                </div>
                            </b-form-group>
                        </b-form>
                    </div>
                    <!-- end card-body -->
                </div>
            </BModal>
            <BModal v-model="modalUpload_Ktp" hide-footer="true" hide-header="true">
                <div class="card overflow-hidden">
                    <div class="bg-soft bg-primary">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">Upload KTP User Customer</h5>
                                    <p>Buat akun anda</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img
                                    alt
                                    class="img-fluid"
                                    src="@/assets/images/logo_zaj.png"
                                    width="150"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div>
                            <router-link to="/">
                                <div class="avatar-md profile-user-wid mb-4">
                  <span class="avatar-title rounded-circle bg-light">
                    <img
                        alt
                        class="rounded-circle"
                        height="34"
                        src="@/assets/images/logo.svg"
                    />
                  </span>
                                </div>
                            </router-link>
                        </div>
                        <b-form class="p-2">

                            <input
                                id="inputGroupFile01"
                                ref="fileInput"
                                class="form-control"
                                type="file"
                                @change="handleFileChange"
                            />
                            <BAlert
                                v-if="errors['foto']"
                                :model-value="true"
                                class="mt-2"
                                variant="danger"
                            >{{ errors["foto"][0] }}
                            </BAlert
                            >

                            <div class="mt-4 d-grid">
                                <BButton :disabled="saving" variant="primary" @click="uploadKtp">
                                    <span class="mx-3">Save</span>
                                    <BSpinner v-if="saving" small/>
                                </BButton>
                            </div>
                        </b-form>
                    </div>
                    <!-- end card-body -->
                </div>
            </BModal>
            <FsLightbox
                :sources="sources"
                :toggler="toggler"
                type="image"
            />
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-between">
                    <b-button
                        class="mb-3"
                        size="sm"
                        variant="primary"
                        @click="modalAdd = !modalAdd"
                    >Tambah Customer
                    </b-button
                    >
                    <!--                    <download-excel-->
                    <!--                        :data="customers"-->
                    <!--                        :fields="export_fields"-->
                    <!--                        :name="generateFilename('data-customer')"-->
                    <!--                        :title="toUpperCase(title)"-->
                    <!--                        worksheet="Data-Customer"-->
                    <!--                    >-->
                    <!--                        <b-button class="mb-3" size="md" variant="success"-->
                    <!--                        >Export Excel-->
                    <!--                        </b-button-->
                    <!--                        >-->
                    <!--                    </download-excel>-->
                </div>
            </div>

            <div v-if="!loading">
                <vue-good-table
                    :columns="columns"
                    :filter-options="filterOptions"
                    :line-numbers="true"
                    :pagination-options="{
            enabled: true,
            mode: 'pages',
          }"
                    :rows="customers"
                    :search-options="{
            enabled: true,
          }"
                    class="custom-table"
                >
                    <template #table-row="props">
             <span v-if="props.column.field == 'customer.foto_identitas'">
                 <span v-if="props.row.customer.foto_identitas === null">
                    Tidak Ada Data Foto
                </span>
                <img v-else :src="props.row.customer.foto_identitas"
                     :width="100"
                     alt="Foto Identitas"
                     class="align-content-center justify-content-center text-center"
                     @click="lightBoxImages(props.row.customer.foto_identitas)">
                 <br/>
                <br/>
               <b-button
                   v-if="props.row.customer.foto_identitas != null"
                   class="mx-1"
                   size="sm"
                   variant="warning"
                   @click="lightBoxImages(props.row.customer.foto_identitas)"
               >
                Lihat Foto
              </b-button>
            </span>
                        <span v-if="props.column.field == 'customer.limit_pinjaman'">
             {{ formatToRupiah(props.row.customer.limit_pinjaman) }}
            </span>
                        <span v-if="props.column.field == 'actions'">
              <b-button
                  class="m-1"
                  size="sm"
                  variant="warning"
                  @click="setForm(props.row, 'edit')"
              >
                Edit Data
              </b-button>
               <b-button
                   class="m-1"
                   size="sm"
                   variant="info"
                   @click="setForm(props.row, 'upload_ktp')"
               >
                Upload KTP
              </b-button>
              <b-button
                  class="m-1"
                  size="sm"
                  variant="danger"
                  @click="deleteData(props.row.id)"
              >
                Hapus
              </b-button>
              <b-button
                  class="m-1"
                  size="sm"
                  variant="primary"
                  @click="setForm(props.row, 'detail')"
              >
                Detail
              </b-button>
            </span>
                    </template>
                </vue-good-table>
            </div>
            <div
                v-else
                class="d-flex justify-content-center align-items-center"
                style="height: 80vh"
            >
                <BSpinner variant="primary"/>
            </div>
        </b-card>
    </Layout>
</template>
