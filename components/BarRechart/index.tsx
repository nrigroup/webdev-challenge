import { Bar, BarChart, XAxis, YAxis } from "recharts"

const BarRechart = ({ data }: { data: { [key: string]: any }[] }) => {
  return (
    <BarChart width={800} height={600} data={data}>
      <Bar dataKey="preTaxAmount" />
      <XAxis dataKey="date" />
      <YAxis />
    </BarChart>
  )
}

export default BarRechart
