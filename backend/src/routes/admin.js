const express = require('express');
const {asignarRol}=require("../controllers/adminController");
const router = express.Router();

router.post('/asignarRol',asignarRol);

module.exports=router;
