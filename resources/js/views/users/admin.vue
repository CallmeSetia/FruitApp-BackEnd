<script>
import Layout from "../../layouts/main.vue";
// import appConfig from "@/app.config";
// import PageHeader from "@/components/page-header";
import axios from "axios";
import Swal from "sweetalert2";
// import JsonExcel from "vue-json-excel3";

/**
 * Dashboard Component
 */
export default {
    page: {
        title: "Data Admin",
        meta: [
            {
                name: "description",
            },
        ],
    },
    components: {
        Layout,
        // downloadExcel: JsonExcel,
        // PageHeader,
    },
    data() {
        return {
            modalAdd: false,
            modalEdit: false,
            modalDetail: false,
            admins: [],
            title: "Data Admin",
            items: [
                {
                    text: "Data Admins",
                    href: "/",
                },
                {
                    text: "Default",
                    active: true,
                },
            ],
            columns: [
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
                    label: "Username",
                    field: "username",
                    filterOptions: {
                        styleClass: "class1",
                        enabled: true,
                        placeholder: "Cari berdasarkan Username...",
                        filterValue: "",
                    },
                },
                {
                    label: "Role",
                    hidden : true,
                    field: "role",
                    filterOptions: {
                        styleClass: "class1",
                        enabled: true,
                        placeholder: "Cari berdasarkan Username...",
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
                password: null,
                role: "",
            },
            loading: false,
            saving: false,
            errors: [],
            export_fields: {
                name: "name",
                username: "username",
                role: "role",
            },
            kategoris: [
                { value: "admin", text: "ADMIN" },
                { value: "superuser", text: "SUPER ADMIN" },
            ],
        };
    },

    methods: {
        async getAdmins() {
            try {
                this.loading = true;
                const response = await axios.get(`/api/user/admin`);
                this.admins = response.data.data
                console.log(response);
                this.loading = false;
            } catch (error) {
                this.loading = false;
            }
        },
        async saveData() {
            try {
                this.saving = true;

                let url = "/api/user/admin";


                let formData = new FormData();
                formData.append("name", this.form.name);
                formData.append("username", this.form.username);
                if (this.form.password !== null)  formData.append("password", this.form.password);

                formData.append("role", this.form.role);

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
                            text: `Error : ${error.response.data.message}`,
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

                this.getAdmins();
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
                password: null,
                role: "admin",
            };

            switch (type) {
                case "edit":
                    this.modalEdit = !this.modalEdit;
                    break;
                case "detail":
                    this.modalDetail = !this.modalDetail;
                    break;
                default:
                    break;
            }
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

                        const response = await axios.post(`/api/user/admin`, formData);

                        console.log(response.data.message)
                        Swal.fire({
                            icon: "success",
                            title: "Deleted!",
                            text: response.data.message,
                        });

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
                this.getAdmins();
            });
        },

        getRoleText(role) {
            // Find the corresponding text for the given role value
            const roleObj = this.kategoris.find((item) => item.value === role);

            // Return the text or a default value if not found
            return roleObj ? roleObj.text : "Unknown Role";
        },
    },

    watch: {
        modalAdd: {
            handler(val) {
                if (!val) {
                    this.form = {
                        name: "",
                        username: "",
                        password: null,
                        role: "",
                    };
                    this.errors = [];
                }
            },
        },
        modalEdit: {
            handler(val) {
                if (!val) {
                    this.form = {
                        name: "",
                        username: "",
                        password: null,
                        role: "",
                    };
                    this.errors = [];
                }
            },
        },
    },

    mounted() {
        this.getAdmins();
    },
};
</script>

<template>
    <Layout>
        <PageHeader :title="title" :items="items" />

        <b-card
            title="Data User Admin"
            sub-title="Card subtitle"
            style="margin-top: -20px"
        >
            <BModal v-model="modalAdd" hide-footer="true" hide-header="true">
                <div class="card overflow-hidden">
                    <div class="bg-soft bg-primary">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">Tambah User Admin</h5>
                                    <p>Buat akun anda</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img
                                    src="@/assets/images/logo_zaj.png"
                                    alt
                                    width="150"
                                    class="img-fluid"
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
                        src="@/assets/images/logo.svg"
                        alt
                        class="rounded-circle"
                        height="34"
                    />
                  </span>
                                </div>
                            </router-link>
                        </div>
                        <b-form class="p-2">
                            <b-form-group
                                class="mb-3"
                                id="email-group"
                                label="Nama"
                                label-for="name"
                            >
                                <b-form-input
                                    id="username"
                                    type="text"
                                    v-model="form.name"
                                    placeholder="Masukkan Nama"
                                    :class="{
                    'is-invalid': submitted && v$.user.name.$error,
                  }"
                                ></b-form-input>
                                <BAlert
                                    :model-value="true"
                                    v-if="errors['name']"
                                    variant="danger"
                                    class="mt-2"
                                >{{ errors["name"][0] }}</BAlert
                                >
                            </b-form-group>

                            <b-form-group
                                class="mb-3"
                                id="email-group"
                                label="Username"
                                label-for="username"
                            >
                                <b-form-input
                                    id="username"
                                    type="text"
                                    v-model="form.username"
                                    placeholder="Masukkan Username"
                                    :class="{
                    'is-invalid': submitted && v$.user.name.$error,
                  }"
                                ></b-form-input>
                                <BAlert
                                    :model-value="true"
                                    v-if="errors['username']"
                                    variant="danger"
                                    class="mt-2"
                                >{{ errors["username"][0] }}</BAlert
                                >
                            </b-form-group>

                            <b-form-group
                                class="mb-3"
                                id="email-group"
                                label="Password"
                                label-for="password"
                            >
                                <b-form-input
                                    id="password"
                                    type="password"
                                    v-model="form.password"
                                    placeholder="Input Password"
                                    :class="{
                    'is-invalid': submitted && v$.user.address.$error,
                  }"
                                ></b-form-input>
                                <BAlert
                                    :model-value="true"
                                    v-if="errors['password']"
                                    variant="danger"
                                    class="mt-2"
                                >{{ errors["password"][0] }}</BAlert
                                >
                            </b-form-group>

                            <b-form-group
                                class="mb-3"
                                id="email-group"
                                label="Role"
                                label-for="role"
                            >
                                <BFormSelect v-model="form.role" :options="roles" >
                                    <option value="admin">Admin</option>
                                    <option value="super_admin">Super Admin</option>
                                </BFormSelect>
                                <BAlert
                                    :model-value="true"
                                    v-if="errors['role']"
                                    variant="danger"
                                    class="mt-2"
                                >{{ errors["role"][0] }}</BAlert
                                >
                            </b-form-group>
                            <div class="mt-4 d-grid">
                                <BButton variant="primary" :disabled="saving" @click="saveData">
                                    <span class="mx-3">Save</span>
                                    <BSpinner small v-if="saving" />
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
                                    <h5 class="text-primary">Edit Admin</h5>
                                    <p>Edit akun anda</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img
                                    src="@/assets/images/logo_zaj.png"
                                    alt
                                    width="150"
                                    class="img-fluid"
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
                        src="@/assets/images/logo.svg"
                        alt
                        class="rounded-circle"
                        height="34"
                    />
                  </span>
                                </div>
                            </router-link>
                        </div>

                        <b-form class="p-2">
                            <b-form-group
                                class="mb-3"
                                id="email-group"
                                label="Nama"
                                label-for="name"
                            >
                                <b-form-input
                                    id="username"
                                    type="text"
                                    v-model="form.name"
                                    placeholder="Masukkan Nama"
                                    :class="{
                    'is-invalid': submitted && v$.user.name.$error,
                  }"
                                ></b-form-input>
                                <BAlert
                                    :model-value="true"
                                    v-if="errors['name']"
                                    variant="danger"
                                    class="mt-2"
                                >{{ errors["name"][0] }}</BAlert
                                >
                            </b-form-group>

                            <b-form-group
                                class="mb-3"
                                id="email-group"
                                label="Username"
                                label-for="username"
                            >
                                <b-form-input
                                    id="username"
                                    type="text"
                                    v-model="form.username"
                                    placeholder="Masukkan Username"
                                    :class="{
                    'is-invalid': submitted && v$.user.name.$error,
                  }"
                                ></b-form-input>
                                <BAlert
                                    :model-value="true"
                                    v-if="errors['username']"
                                    variant="danger"
                                    class="mt-2"
                                >{{ errors["username"][0] }}</BAlert
                                >
                            </b-form-group>

                            <b-form-group
                                class="mb-3"
                                id="email-group"
                                label="Password"
                                label-for="password"
                            >
                                <b-form-input
                                    id="password"
                                    type="password"
                                    v-model="form.password"
                                    placeholder="Input Password"
                                    :class="{
                    'is-invalid': submitted && v$.user.address.$error,
                  }"
                                ></b-form-input>
                                <BAlert
                                    :model-value="true"
                                    v-if="errors['password']"
                                    variant="danger"
                                    class="mt-2"
                                >{{ errors["password"][0] }}</BAlert
                                >
                            </b-form-group>

                            <b-form-group
                                class="mb-3"
                                id="email-group"
                                label="Role"
                                label-for="role"
                            >
                                <BFormSelect v-model="form.role" :options="kategoris" />
                                <BAlert
                                    :model-value="true"
                                    v-if="errors['role']"
                                    variant="danger"
                                    class="mt-2"
                                >{{ errors["role"][0] }}</BAlert
                                >
                            </b-form-group>
                            <div class="mt-4 d-grid">
                                <BButton variant="primary" :disabled="saving" @click="saveData">
                                    <span class="mx-3">Save</span>
                                    <BSpinner small v-if="saving" />
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
                                    <h5 class="text-primary">Detail User ( {{ form.name }} )</h5>
                                    <p>Detail</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img
                                    src="@/assets/images/logo_zaj.png"
                                    alt
                                    width="150"
                                    class="img-fluid"
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
                        src="@/assets/images/logo.svg"
                        alt
                        class="rounded-circle"
                        height="34"
                    />
                  </span>
                                </div>
                            </router-link>
                        </div>

                        <b-form class="p-2">
                            <b-form-group
                                class="mb-3"
                                id="email-group"
                                label="Nama"
                                label-for="name"
                            >
                                <div class="m-2">
                                    <p>{{ form.name }}</p>
                                </div>
                            </b-form-group>

                            <b-form-group
                                class="mb-3"
                                id="email-group"
                                label="Username"
                                label-for="username"
                            >
                                <div class="m-2">
                                    <p>{{ form.username }}</p>
                                </div>
                            </b-form-group>

                            <b-form-group
                                class="mb-3"
                                id="email-group"
                                label="Role"
                                label-for="role"
                            >
                                <div class="m-2">
                                    <p>{{ getRoleText(form.role) }}</p>
                                </div>
                            </b-form-group>
                        </b-form>
                    </div>
                    <!-- end card-body -->
                </div>
            </BModal>

            <div class="row">
                <div class="col-lg-12 d-flex justify-content-between">
                    <b-button
                        size="sm"
                        variant="primary"
                        @click="modalAdd = !modalAdd"
                        class="mb-3"
                    >Tambah Admin</b-button
                    >
                    <download-excel
                        :data="admins"
                        :fields="export_fields"
                        worksheet="Admin Pages"
                        name="data-admin.xls"
                    >
                        <b-button size="md" variant="success" class="mb-3"
                        >Export Excel</b-button
                        >
                    </download-excel>
                </div>
            </div>

            <div v-if="!loading">
                <vue-good-table
                    class="custom-table"
                    :columns="columns"
                    :rows="admins"
                    :search-options="{
            enabled: true,
          }"
                    :pagination-options="{
            enabled: true,
            mode: 'pages',
          }"
                    :line-numbers="true"
                    :filter-options="filterOptions"
                >
                    <template #table-row="props">
            <span v-if="props.column.field == 'actions'">
              <b-button
                  size="sm"
                  @click="setForm(props.row, 'edit')"
                  class="mx-1"
                  variant="warning"
              >
                Edit Data
              </b-button>
              <b-button
                  size="sm"
                  class="mx-1"
                  variant="danger"
                  @click="deleteData(props.row.id)"
              >
                Hapus
              </b-button>
              <b-button
                  size="sm"
                  class="mx-1"
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
                class="d-flex justify-content-center align-items-center"
                style="height: 80vh"
                v-else
            >
                <BSpinner variant="primary" />
            </div>
        </b-card>
    </Layout>
</template>
