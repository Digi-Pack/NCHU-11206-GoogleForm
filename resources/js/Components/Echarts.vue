<script>
import * as echarts from 'echarts/core';
// 基礎柱狀、條形圖、柱狀圖標籤旋轉、按行按列分布、最簡單數據集
import {
  DatasetComponent,
  ToolboxComponent,
  TitleComponent,
  TooltipComponent,
  LegendComponent,
  GridComponent,
} from 'echarts/components';
import {
  PieChart,
  BarChart,
} from 'echarts/charts';
import { LabelLayout } from 'echarts/features';
import { CanvasRenderer } from 'echarts/renderers';

echarts.use([
  DatasetComponent,
  ToolboxComponent,
  TitleComponent,
  TooltipComponent,
  LegendComponent,
  GridComponent,
  BarChart,
  PieChart,
  CanvasRenderer,
  LabelLayout,
]);

import VChart, { THEME_KEY } from 'vue-echarts';

export default {
  components: {
    VChart,
  },
  extends: echarts,
  provide: {
    [THEME_KEY]: 'white',
  },
  props: {
    chartData: {
      type: Object,
      default: null,
    },
    options: {
      type: Object,
      default: null,
    },
  },
//   watch: {
//     chartData() {
//       this.renderChart();
//     },
//   },
//   mounted() {
//     this.renderChart(this.chartData, this.options);
//   },
};
</script>

<template id="myChart">
  <slot />
  <VChart ref="chart" :options="options" autoresize />
</template>

<style lang="scss" scoped>
#chart {
}
</style>

