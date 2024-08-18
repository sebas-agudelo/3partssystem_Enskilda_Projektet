import express from "express";
import {
  deleteProduct,
  getAllProducts,
  getProductById,
  postNewProduct,
  updateProduct,
} from "../controllers/productsController.js";

export const router = express.Router();

router.get("/", getAllProducts);

router.get('/product/:id', getProductById);

router.post("/post", postNewProduct);

router.put("/update/:id", updateProduct);

router.delete("/delete/:id", deleteProduct);
