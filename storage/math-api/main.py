from fastapi import FastAPI
from pydantic import BaseModel
import json

import sympy

class Item(BaseModel):
    expr1: str
    expr2: str 

app = FastAPI(ssl_keyfile="/home/xsomor/webte.fei.stuba.sk.key", ssl_certfile="/home/xsomor/webte_fei_stuba_sk.pem")

@app.post("/compare")
async def compare_func(expr:Item):
    #item_dict = item.dict()
    #async def read_porovnaj2(expr1:str="2/(s+4)",expr2:str="4/(2*s+8)"):
    # s = sympy.Symbol('s')
    # expr1 = eval(expr1)
    # expr2 = eval(expr2)
    simplified_expr1 = sympy.simplify(expr.expr1)
    simplified_expr2 = sympy.simplify(expr.expr2)
    if simplified_expr1 == simplified_expr2:
        result = 1
    else:
        result = 0
    return {"result": result} 
    #return expr
