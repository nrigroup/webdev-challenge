import { Bar, BarChart, XAxis, YAxis } from "recharts"

const BarRechart = ({
  data,
  barDataKey,
  xAxisDataKey,
  xAxisLabel,
}: {
  data: { [key: string]: any }[]
  barDataKey: string
  xAxisDataKey: string
  xAxisLabel: string
}) => {
  return (
    <BarChart width={800} height={600} data={data}>
      <Bar dataKey={barDataKey} />
      <XAxis dataKey={xAxisDataKey} fontSize="0.5rem" label={xAxisLabel} />
      <YAxis />
    </BarChart>
  )
}

export default BarRechart
