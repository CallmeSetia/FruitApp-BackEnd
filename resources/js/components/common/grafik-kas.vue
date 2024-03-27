<script>
import axios from "axios";
import Vue3ChartJs from "@j-t-mcc/vue3-chartjs";

export default {
    components: {
        Vue3ChartJs,
    },
    data() {
        return {
            period: "1m",
            fetching: false,
            line : {
                type: "line",
                data: {
                    labels: [
                        "January",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "Desember"
                    ],
                    datasets: [{
                        label: "Pengeluaran",
                        fill: true,
                        lineTension: 0.5,
                        backgroundColor: "rgba(241, 182, 80, 0.2)",
                        borderColor: "#F1B650",
                        borderCapStyle: "butt",
                        borderDash: [],
                        borderDashOffset: 0.0,
                        borderJoinStyle: "miter",
                        pointBorderColor: "#F1B650",
                        pointBackgroundColor: "#fff",
                        pointBorderWidth: 1,
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "#F1B650",
                        pointHoverBorderColor: "#fff",
                        pointHoverBorderWidth: 2,
                        pointRadius: 1,
                        pointHitRadius: 10,
                        data: [],
                    },
                        {
                            label: "Pemasukan",
                            fill: true,
                            lineTension: 0.5,
                            backgroundColor: "rgba(85, 110, 230, 0.2)",
                            borderColor: "#556ee6",
                            borderCapStyle: "butt",
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: "miter",
                            pointBorderColor: "#556ee6",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "#556ee6",
                            pointHoverBorderColor: "#eef0f2",
                            pointHoverBorderWidth: 2,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            data: [],
                        },
                    ],
                },
                options: {
                    defaultFontColor: "#8791af",
                    responsive: true,
                    maintainAspectRatio: false,

                    xAxes: [{
                        gridLines: {
                            color: "rgba(166, 176, 207, 0.1)",
                        },
                    },],
                    yAxes: [{
                        ticks: {
                            max: 100,
                            min: 20,
                            stepSize: 10,
                        },
                        gridLines: {
                            color: "rgba(166, 176, 207, 0.1)",
                        },
                    },],
                },
            }
        }
    },

    methods: {
        async getKasOperasional() {
            this.fetching = true;
            const response = await axios.get(
                `/api/dashboard/chart/kasoperasional?period=${this.period}`
            );
            const tampungDataPemasukan = [];
            const tampungDataPengeluaran = [];
            for (let index = 0; index < 12; index++) {

                const sum = [];
                const sumPengeluaran = [];
                response.data.data.forEach(element => {
                    const date = new Date(element.datetime)
                    if(index==date.getMonth())
                    {
                        sum.push(parseInt(element.pemasukan))
                        sumPengeluaran.push(parseInt(element.pengeluaran))
                    }
                });
                tampungDataPemasukan.push(sum.reduce((acc, currentValue) => acc + currentValue, 0))
                tampungDataPengeluaran.push(sumPengeluaran.reduce((acc, currentValue) => acc + currentValue, 0))
            }
            this.line.data.datasets[0].data = tampungDataPemasukan;
            this.line.data.datasets[1].data = tampungDataPengeluaran;
            this.fetching = false;
        },

        async filter(period) {
            this.fetching = true;
            const response = await axios.get(
                `/api/dashboard/chart/kasoperasional?period=${period}`
            );
            const tampungData = [];
            const tampungDataPengeluaran = [];
            for (let index = 0; index < 12; index++) {

                const sum = [];
                const sumPengeluaran = [];
                response.data.data.forEach(element => {
                    const date = new Date(element.datetime)
                    if(index==date.getMonth())
                    {
                        sum.push(parseInt(element.pemasukan))
                        sumPengeluaran.push(parseInt(element.pengeluaran))
                    }
                });
                tampungData.push(sum.reduce((acc, currentValue) => acc + currentValue, 0))
                tampungDataPengeluaran.push(sumPengeluaran.reduce((acc, currentValue) => acc + currentValue, 0))
            }
            this.line.data.datasets[0].data = tampungData;
            this.line.data.datasets[1].data = tampungDataPengeluaran;
            this.fetching = false;
        }
        // getMonthName(dateString) {
        //   const [year, month] = dateString.split("-");
        //   const date = new Date(year, month - 1);
        //   const monthName = date.toLocaleString("en-us", { month: "long" });
        //   return monthName;
        // },
        // getFirstThreeWords(inputString) {
        //   const words = inputString.match(/\S+/g);
        //   if (words && words.length >= 3) {
        //     return words.slice(0, 3).join(" ");
        //   }
        //   return inputString;
        // },
        // toRupiah(hasil) {
        //   return new Intl.NumberFormat("id-ID", {
        //     style: "currency",
        //     currency: "IDR",
        //   }).format(hasil);
        // },
    },

    mounted() {
        // this.getKasOperasional()
    },

    watch: {
        data(newval, oldval) {
            if (newval != oldval) return this.filter()
        }
    }

    // watch: {
    // dataByMonth: {
    //   handler(newVal) {
    //     this.fetching = false;

    //     this.columnChart.series[0].data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    //     this.columnChart.series[1].data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

    //     for (const key in newVal) {
    //       const monthName = this.getMonthName(key);
    //       let get3 = monthName.substring(0, 3);
    //       let index =
    //         this.columnChart.chartOptions.xaxis.categories.indexOf(get3);

    //       this.columnChart.series[0].data[index] = newVal[key].laba;
    //       this.columnChart.series[1].data[index] = newVal[key].rugi;
    //     }
    //   },
    //   deep: true,
    // },
    // periode: {
    //   handler(newVal) {
    //     this.periode = newVal;
    //     this.getKasBesar();
    //   },
    // },
    // },
};
</script>
<template>
    <div class="card">
        <div class="card-body" v-if="!fetching">
            <div class="row d-flex between">
                <b-row align-h="between">
                    <b-col cols="6">
                        <h4 class="card-title mb-4">
                            Kas Operasional/Kas Kecil
                        </h4>
                    </b-col>
                    <b-col cols="6" class="text-end">
                        <button class="btn btn-primary">Export</button>
                        <button
                            class="btn btn-filter"
                            style="margin-left: 5px"
                            @click="filter('1m')"
                        >
                            1M
                        </button>
                        <button
                            class="btn btn-filter"
                            style="margin-left: 5px"
                            @click="filter('6m')"
                        >
                            6M
                        </button>
                        <button
                            class="btn btn-filter"
                            style="margin-left: 5px"
                            @click="filter('1y')"
                        >
                            1Y
                        </button>
                    </b-col>
                </b-row>
            </div>
            <!-- Line Chart -->

            <vue3-chart-js
                class="chartjs-chart"
                v-bind="{ ...line }"
            ></vue3-chart-js>
        </div>
        <div v-else
             class="d-sm-flex flex-wrap justify-content-center align-items-center"
             style="height: 390px"
        >
            <BSpinner variant="primary" />
        </div>
    </div>
</template>
<style>
.btn-filter {
    background-color: #f6f6f9;
}
</style>
