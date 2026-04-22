#include <stdio.h>
#include <conio.h>
#include <graphics.h>
#include <math.h>

void main() {
    int gd = DETECT, gm;
    int x1 = 100, y1 = 100, x2 = 200, y2 = 150;
    int dx, dy, p, x, y;

    initgraph(&gd, &gm, "C:\\TurboC3\\BGI");

    dx = x2 - x1;
    dy = y2 - y1;
    p = 2 * dy - dx;
    x = x1;
    y = y1;

    while (x <= x2) {
        putpixel(x, y, WHITE);
        x++;
        if (p < 0) {
            p = p + 2 * dy;
        } else {
            y++;
            p = p + 2 * dy - 2 * dx;
        }
    }

    getch();
    closegraph();
}
