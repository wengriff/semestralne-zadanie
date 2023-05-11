from fastapi import FastAPI
from pydantic import BaseModel
import json
from sympy import symbols, simplify
from sympy.parsing.latex import parse_latex
import sympy

app = FastAPI(ssl_keyfile="/home/xsomor/webte.fei.stuba.sk.key", ssl_certfile="/home/xsomor/webte_fei_stuba_sk.pem")

class Item(BaseModel):
    expr1: str
    expr2: str 

def compare_expr(expr1, expr2):
    # x = symbols('x')
    parsed_expr1 = parse_latex(expr1)
    parsed_expr2 = parse_latex(expr2)
    simplified_expr1 = simplify(parsed_expr1)
    simplified_expr2 = simplify(parsed_expr2)

    return simplified_expr1 == simplified_expr2

@app.post("/compare")
async def compare_func(expr:Item):
    if compare_expr(expr.expr1,expr.expr2):
        result = 1
    else:
        result = 0
    return {"result":result} 
