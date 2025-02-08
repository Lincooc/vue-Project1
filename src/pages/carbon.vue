<template>
    <div class="carbon-calculator">
        <h1>碳排放计算器</h1>
        <table class="emission-table">
            <thead>
                <tr>
                    <th>类型</th>
                    <th>描述</th>
                    <th>输入项</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>交通工具</td>
                    <td>选择交通工具类型并输入行驶距离 (公里)</td>
                    <td>
                        <select v-model="transportType">
                            <option value="car">汽车</option>
                            <option value="plane">飞机</option>
                            <option value="train">火车</option>
                            <option value="bus">公交车</option>
                            <option value="bike">自行车</option>
                            <option value="walk">步行</option>
                        </select>
                        <input v-model.number="transportDistance" type="number" placeholder="行驶距离 (km)" />
                    </td>
                </tr>
                <tr>
                    <td>能源消耗</td>
                    <td>选择能源类型并输入消耗量 (kWh)</td>
                    <td>
                        <select v-model="energyType">
                            <option value="electricity">电力</option>
                            <option value="gas">天然气</option>
                        </select>
                        <input v-model.number="energyUsage" type="number" placeholder="消耗量 (kWh)" />
                    </td>
                </tr>
                <tr>
                    <td>饮食习惯</td>
                    <td>选择食物种类并输入食用量 (kg)</td>
                    <td>
                        <select v-model="foodType">
                            <option value="beef">牛肉</option>
                            <option value="pork">猪肉</option>
                            <option value="chicken">鸡肉</option>
                            <option value="vegetables">蔬菜</option>
                            <option value="fruits">水果</option>
                        </select>
                        <input v-model.number="foodQuantity" type="number" placeholder="食用量 (kg)" />
                    </td>
                </tr>
                <tr>
                    <td>购物消费</td>
                    <td>选择购物类型并输入消费金额 (元)</td>
                    <td>
                        <select v-model="shoppingType">
                            <option value="clothes">衣物</option>
                            <option value="electronics">电子产品</option>
                            <option value="furniture">家具</option>
                        </select>
                        <input v-model.number="shoppingAmount" type="number" placeholder="消费金额 (元)" />
                    </td>
                </tr>
                <tr>
                    <td>废弃物管理</td>
                    <td>选择废弃物类型并输入重量 (kg)</td>
                    <td>
                        <select v-model="wasteType">
                            <option value="recyclable">可回收</option>
                            <option value="nonRecyclable">不可回收</option>
                        </select>
                        <input v-model.number="wasteWeight" type="number" placeholder="废弃重量 (kg)" />
                    </td>
                </tr>
            </tbody>
        </table>
        <button @click="calculateEmission">计算碳排放</button>

        <div v-if="carbonEmission !== null" class="result">
            <!-- <h2>碳排放总量：{{ carbonEmission }} kg CO₂</h2> -->
            <canvas id="emissionChart"></canvas>
        </div>
    </div>
</template>


<script lang="ts" setup>
import { ref, onMounted, nextTick } from "vue";
import Chart from "chart.js/auto";

const methods = ref([
    { value: "transport", label: "交通工具" },
    { value: "energy", label: "能源消耗" },
    { value: "food", label: "饮食习惯" },
    { value: "shopping", label: "购物消费" },
    { value: "waste", label: "废弃物管理" },
]);

const selectedMethod = ref<string>("");

const transportType = ref<string>("car");
const transportDistance = ref<number>(0);

const energyType = ref<string>("electricity");
const energyUsage = ref<number>(0);

const foodType = ref<string>("vegetables");
const foodQuantity = ref<number>(0);

const shoppingType = ref<string>("clothes");
const shoppingAmount = ref<number>(0);
const wasteType = ref<string>("recyclable");
const wasteWeight = ref<number>(0);
const carbonEmission = ref<number | null>(null);
let chartInstance: Chart | null = null;

const updateChart = async () => {
    await nextTick(); 

    const ctx = document.getElementById("emissionChart") as HTMLCanvasElement;

    if (!ctx) {
        console.error("图表的 canvas 元素未找到！");
        return;
    }

    const data = {
        labels: ["交通工具", "能源消耗", "饮食习惯", "购物消费", "废弃物管理"],
        datasets: [
            {
                label: "碳排放量 (kg CO₂)",
                data: [
                    transportType.value !== "bike" && transportType.value !== "walk"
                        ? transportDistance.value * (transportType.value === "car" ? 0.12 : 0.25)
                        : 0,
                    energyUsage.value * (energyType.value === "electricity" ? 0.7 : 2.1),
                    foodQuantity.value * (foodType.value === "beef" ? 27 : 1.5),
                    shoppingAmount.value * (shoppingType.value === "electronics" ? 0.05 : 0.03),
                    wasteWeight.value * (wasteType.value === "nonRecyclable" ? 1.8 : 0.5),
                ],
                backgroundColor: ["#ff6384", "#36a2eb", "#cc65fe", "#ffce56", "#4bc0c0"],
            },
        ],
    };

    if (chartInstance) {
        chartInstance.destroy();
    }

    chartInstance = new Chart(ctx, {
        type: "bar",
        data,
    });
};

const calculateEmission = () => {
    let result = 0;

    switch (selectedMethod.value) {
        case "transport":
            if (transportType.value === "bike" || transportType.value === "walk") {
                result = 0;
            } else {
                const transportFactors: Record<string, number> = {
                    car: 0.12,
                    plane: 0.25,
                    train: 0.06,
                    bus: 0.08,
                };
                result = transportDistance.value * (transportFactors[transportType.value] || 0);
            }
            break;

        case "energy":
            const energyFactors: Record<string, number> = {
                electricity: 0.7,
                gas: 2.1,
            };
            result = energyUsage.value * (energyFactors[energyType.value] || 0);
            break;

        case "food":
            const foodFactors: Record<string, number> = {
                beef: 27,
                pork: 12.1,
                chicken: 6.9,
                vegetables: 2,
                fruits: 1.5,
            };
            result = foodQuantity.value * (foodFactors[foodType.value] || 0);
            break;

        case "shopping":
            const shoppingFactors: Record<string, number> = {
                clothes: 0.02,
                electronics: 0.05,
                furniture: 0.03,
            };
            result = shoppingAmount.value * (shoppingFactors[shoppingType.value] || 0);
            break;

        case "waste":
            const wasteFactors: Record<string, number> = {
                recyclable: 0.5,
                nonRecyclable: 1.8,
            };
            result = wasteWeight.value * (wasteFactors[wasteType.value] || 0);
            break;

        default:
            result = 0;
            break;
    }

    carbonEmission.value = parseFloat(result.toFixed(2));
    updateChart();
};
</script>

<style scoped>
.carbon-calculator {
    max-width: 800px;
    margin: -30px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
}

h1 {
    text-align: center;
    color: #333;
}

.emission-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.emission-table th,
.emission-table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

.emission-table th {
    background-color: #4caf50;
    color: white;
}

.emission-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.emission-table tr:hover {
    background-color: #ddd;
}

button {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #4caf50;
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #45a049;
}

.result {
    text-align: center;
    margin-top: 20px;
}

canvas {
    margin-top: 20px;
    max-width: 100%;
}
input{
        margin-left: 15px;
}
</style>
