import tailwindConfig from 'tailwind.config';
export function useTailwindColors() {
  const tailwindColors = {
    ...tailwindConfig.theme.extend.colors,
  };

  // 將tailwindColors中的顏色定義轉換為所需的格式
  const colors = {};

  for (const [colorName, colorShades] of Object.entries(tailwindColors)) {
    colors[colorName] = {};
    for (const [shadeName, shadeValue] of Object.entries(colorShades)) {
      colors[colorName][shadeName] = shadeValue;
    }
  }

  return {
    colors,
  };
}





