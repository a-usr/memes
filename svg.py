import svgutils
from svgutils.compose import Element
from svgutils.transform import LineElement
def main():
    svg = svgutils.compose.SVG("./shared/background.svg")
    last: Element = svg.find_id("last")
    last = LineElement(last.root)
if __name__ == "__main__":
    main()