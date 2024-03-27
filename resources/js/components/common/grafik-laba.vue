<script>
import axios from "axios";
import { mapGetters } from "vuex";

export default {
    computed: {
        ...mapGetters("kasBesar", ["dataByMonth"]),
    },
    data() {
        return {
            columnChart: {
                series: [
                    {
                        name: "Laba",
                        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    },
                    {
                        name: "Rugi",
                        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    },
                ],
                chartOptions: {
                    chart: {
                        toolbar: {
                            show: false,
                        },
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: "45%",
                            endingShape: "rounded",
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ["transparent"],
                    },
                    colors: ["#34c38f", "#eb2113"],
                    xaxis: {
                        categories: [
                            "Jan",
                            "Feb",
                            "Mar",
                            "Apr",
                            "May",
                            "Jun",
                            "Jul",
                            "Aug",
                            "Sep",
                            "Oct",
                            "Nov",
                            "Dec",
                        ],
                    },
                    yaxis: {
                        title: {
                            text: "IDR (Rupiah)",
                            style: {
                                fontWeight: "500",
                            },
                        },
                    },
                    grid: {
                        borderColor: "#f1f1f1",
                    },
                    fill: {
                        opacity: 1,
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return new Intl.NumberFormat("id-ID", {
                                    style: "currency",
                                    currency: "IDR",
                                }).format(val);
                            },
                        },
                    },
                },
            },
            test: [],
            show: false,
            fetching: true,
            periode: "1m",
        };
    },

    methods: {
        async getKasBesar() {
            this.fetching = true;
            const response = await axios.get(
                `/api/dashboard/chart/kasbesar?period=${this.periode}`
            );
            this.$store.dispatch("kasBesar/setKasBesar", response.data.data);
            this.fetching = false;
        },
        getMonthName(dateString) {
            const [year, month] = dateString.split("-");
            const date = new Date(year, month - 1);
            const monthName = date.toLocaleString("en-us", { month: "long" });
            return monthName;
        },
        getFirstThreeWords(inputString) {
            const words = inputString.match(/\S+/g);
            if (words && words.length >= 3) {
                return words.slice(0, 3).join(" ");
            }
            return inputString;
        },
        toRupiah(hasil) {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR",
            }).format(hasil);
        },
    },

    watch: {
        dataByMonth: {
            handler(newVal) {
                this.fetching = false;

                this.columnChart.series[0].data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                this.columnChart.series[1].data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

                for (const key in newVal) {
                    const monthName = this.getMonthName(key);
                    let get3 = monthName.substring(0, 3);
                    let index =
                        this.columnChart.chartOptions.xaxis.categories.indexOf(get3);

                    this.columnChart.series[0].data[index] = newVal[key].laba;
                    this.columnChart.series[1].data[index] = newVal[key].rugi;
                }
            },
            deep: true,
        },
        periode: {
            handler(newVal) {
                this.periode = newVal;
                this.getKasBesar();
            },
        },
    },
};
</script>
<template>
    <div class="card">
        <div class="card-body">
            <div class="d-sm-flex flex-wrap justify-content-between" v-if="!fetching">
                <h4 class="card-title mb-4">Grafik Laba Rugi</h4>
                <div>
                    <BDropdown v-model="show" text="Export" variant="primary">
                        <BDropdownItem>Excel</BDropdownItem>
                        <BDropdownItem>Image</BDropdownItem>
                    </BDropdown>
                    <button
                        class="btn btn-filter"
                        style="margin-left: 5px"
                        @click="() => (periode = '1m')"
                    >
                        1m
                    </button>
                    <button
                        class="btn btn-filter"
                        style="margin-left: 5px"
                        @click="() => (periode = '6m')"
                    >
                        6m
                    </button>
                    <button
                        class="btn btn-filter"
                        style="margin-left: 5px"
                        @click="() => (periode = '1y')"
                    >
                        1Y
                    </button>
                </div>
                <div class="col-lg-12">
                    <apexchart
                        class="apex-charts"
                        height="350"
                        type="bar"
                        dir="ltr"
                        :series="columnChart.series"
                        :options="columnChart.chartOptions"
                    ></apexchart>
                </div>
            </div>
            <div
                v-else
                class="d-sm-flex flex-wrap justify-content-center align-items-center"
                style="height: 390px"
            >
                <BSpinner variant="primary" />
            </div>
        </div>
    </div>
</template>
<style>
.btn-filter {
    background-color: #f6f6f9;
}
</style>
