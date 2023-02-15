export const isCsvFileValid = (csvFile) => {
  const types = ["text/csv"];

  return types.includes(csvFile.type);
};
