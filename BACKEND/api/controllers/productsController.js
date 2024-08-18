import {productsModel} from '../dbModel/dbModel.js'

export const getAllProducts = async (req, res) => {
    try{
        const result = await productsModel.find();
         
        return res.status(200).json(result);

    }catch(error){
        return res.status(500).json({error: "Server fel 500"});
    }
};

export const postNewProduct = async (req, res) => {
    const {title, price} = req.body;

    try{
        const newProduct = new productsModel({
            title: title,
            price: price,
          });
        
          if (!title || !price) {
            return res.status(400).json({
              error: "Produktens alla fält bör fyllas i!! Försök igen",
            });
          } else {
            newProduct.save();
            res.status(201).json(newProduct);
          };

    }catch(error){
        return res.status(500).json({error: "Server fel 500"});
    }
};

export const updateProduct = async (req, res) => {
    const { id } = req.params;
    const { title, price } = req.body;
  
    try {
      const result = await productsModel.updateOne({ _id: id }, { title, price });
  
      const productId = await productsModel.findById(id);
  
      if(!productId){
        return res.status(404).json({error: "Produkten som du försöker uppdatera finns inte!"});

      } else if(!title || !price){
        return res.status(400).json({error: "Produktens alla fält bör fyllas i!! Försök igen"});

      } else{
        return res.status(200).json({message: "Produkt uppdateringen lyckades!", result});
        
      }
  
    } catch (err) {
      console.log(err);
      return res.status(500).json({error: "Något gick fel med servern"})
    };
};

export const deleteProduct = async (req, res) => {
    const { id } = req.params;

  try {
    const result = await productsModel.deleteOne({ _id: id });

    if (result.length < 0) {
      return res
        .status(404)
        .json({ error: "Produkten som du försöker radera finns inte!" });
    } else {
      return res.status(200).json(result);
    }
  } catch (error) {
      console.log(error);
    return res.status(500).json({error: "Något gick fel med servern"})
  }
};