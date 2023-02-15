export const calculateTotalAmount = (data) => {
  let totalAmount = {
    perDay: {},
    perCategory: {},
    perCondition: {},
  }

  if (!data) return totalAmount

  for (let key of data) {
    totalAmount.perDay[key.date] =
      (totalAmount.perDay[key.date] || 0) + Number(key['pre-tax amount'])

    totalAmount.perCategory[key.category] =
      (totalAmount.perCategory[key.category] || 0) +
      Number(key['pre-tax amount'])

    totalAmount.perCondition[key['lot condition']] =
      (totalAmount.perCondition[key['lot condition']] || 0) +
      Number(key['pre-tax amount'])
  }

  return totalAmount
}
