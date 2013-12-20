; XLAT.ASM
; Demonstrates character encoding using XLAT instruction
; From http://www.c-jump.com/CIS77/samples/XLAT.htm

.386                ; Tells MASM to use Intel 80386 instruction set.
.MODEL FLAT         ; Flat memory model
option casemap:none ; Treat labels as case-sensitive

.STACK 100h     ; (default is 1-kilobyte stack)

.DATA           ; Begin initialized data segment
                ; Table for encrypting digits:
				; Input digits:     0 1 2 3 4 5 6 7 8 9
				; Encrypted digits: 4 6 9 5 0 3 1 8 7 2
xlat_table	DB      "4695031872"
													    
.CODE           ; Begin code segment
_main PROC      ; Beginning of code

    mov    ebx, OFFSET xlat_table
    mov    al, '5' ; put input character into AL
    sub    al, '0' ; convert input character to index
    xlatb          ; AL = encrypted digit character
    ret
													    
_main ENDP
END _main       ; Marks the end of the module and sets the program entry point label
