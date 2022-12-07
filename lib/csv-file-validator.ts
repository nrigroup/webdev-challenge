import { ValidatorConfig } from "csv-file-validator"
import validator from "validator"

export const itemSaleFileParseConfig: ValidatorConfig = {
  headers: [
    {
      name: "date",
      inputName: "date",
      required: true,
      validate: (value) => {
        const date = new Date(value)
        if (Object.prototype.toString.call(date) === "[object Date]") {
          if (isNaN(date as unknown as number)) {
            return false
          }
          return true
        } else {
          return false
        }
      },
      validateError: (headerName, rowNumber, columnNumber) =>
        `${headerName} in the ${rowNumber} / ${columnNumber} column is not a valid date`,
    },
    { name: "category", inputName: "category", required: true },
    { name: "lot title", inputName: "auctionItem", required: true },
    { name: "lot location", inputName: "location", required: true },
    { name: "lot condition", inputName: "condition", required: true },
    {
      name: "pre-tax amount",
      inputName: "preTaxAmount",
      required: true,
      validate: (value) => validator.isNumeric(value),
      validateError: (headerName, rowNumber, columnNumber) =>
        `${headerName} in the ${rowNumber} / ${columnNumber} column is not a valid amount`,
    },
    { name: "tax name", inputName: "tax", optional: true, required: false },
    {
      name: "tax amount",
      inputName: "taxAmount",
      optional: true,
      required: false,
      validate: (value) => validator.isNumeric(value),
      validateError: (headerName, rowNumber, columnNumber) =>
        `${headerName} in the ${rowNumber} / ${columnNumber} column is not a valid amount`,
    },
  ],
}