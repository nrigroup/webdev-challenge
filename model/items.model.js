module.exports = (sequelize, Sequelize) => {
  const Item = sequelize.define("items", {
    date: {
      type: Sequelize.DATE,
    },
    category: {
      type: Sequelize.STRING,
    },
    lot_title: {
      type: Sequelize.STRING,
    },
    lot_location: {
      type: Sequelize.STRING,
    },
    lot_condition: {
      type: Sequelize.STRING,
    },
    pre_tax_amount: {
      type: Sequelize.INTEGER,
    },
    tax_name: {
      type: Sequelize.STRING,
    },
    tax_amount: {
      type: Sequelize.DECIMAL,
    },
  });
  return Item;
};
