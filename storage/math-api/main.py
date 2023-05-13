from fastapi import FastAPI, HTTPException
from pydantic import BaseModel, Field, validator
import json
import re
from sympy import symbols, simplify
from sympy.parsing.latex import parse_latex
from sympy.parsing.latex.errors import LaTeXParsingError
import sympy


app = FastAPI(ssl_keyfile="/home/xsomor/webte.fei.stuba.sk.key", ssl_certfile="/home/xsomor/webte_fei_stuba_sk.pem")

class Item(BaseModel):
    expr1: str = Field(..., min_length=1)
    expr2: str = Field(..., min_length=1)
    
    @validator('expr1', 'expr2')
    def validate_latex(cls, value):
        # rudimentary check for invalid latex
        if not re.match("^[\s\S]*$", value):
            raise ValueError('Invalid latex syntax')
        return value

def compare_expr(expr1, expr2):
    # x = symbols('x')
    try:
        parsed_expr1 = parse_latex(expr1)
        parsed_expr2 = parse_latex(expr2)
    except LaTeXParsingError:
        raise HTTPException(status_code=400, detail="Invalid LaTeX expression")
    
    try:
        simplified_expr1 = simplify(parsed_expr1)
        simplified_expr2 = simplify(parsed_expr2)
    except Exception:
        raise HTTPException(status_code=400, detail="Error during simplification")

    return simplified_expr1 == simplified_expr2

#@app.post("/compare")
#async def compare_func(expr:Item):
   # if compare_expr(expr.expr1,expr.expr2):
   #     result = 1
   # else:
   #     result = 0
   # return {"result":result} 

@app.post("/compare")
async def compare_func(expr: Item):
    try:
        if compare_expr(expr.expr1, expr.expr2):
            result = 1
        else:
            result = 0
    except Exception as e:
        raise HTTPException(status_code=400, detail=str(e))

    return {"result": result}
