import { Pie, PieChart, Tooltip } from "recharts"

const PieRechart = ({
  data,
  dataKey,
  nameKey,
}: {
  data: { [key: string]: any }[]
  dataKey: string
  nameKey: string
}) => {
  return (
    <PieChart width={500} height={500}>
      <Pie dataKey={dataKey} data={data} nameKey={nameKey} />
      <Tooltip />
    </PieChart>
  )
}

export default PieRechart
