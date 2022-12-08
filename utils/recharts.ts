export const tooltipFormatter = (value: string, name: string, props: any) => `$${value}`

export const tickFormatter = (value: string, index?: number) => {
  if (index === 0) {
    return ""
  } else if (parseFloat(value) >= 1000) {
    if (!Number.isInteger(parseFloat(value) / 1000)) {
      return `$${(parseFloat(value) / 1000).toFixed(2)}K`
    }
    return `$${parseFloat(value) / 1000}K`
  }
  return `$${value}`
}
