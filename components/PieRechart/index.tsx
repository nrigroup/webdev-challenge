import { Pie, PieChart } from "recharts"

const PieRechart = ({ data, dataKey }: { data: { [key: string]: any }[]; dataKey: string }) => {
  return (
    <PieChart width={500} height={500}>
      <Pie dataKey={dataKey} data={data} />
    </PieChart>
  )
}

export default PieRechart
