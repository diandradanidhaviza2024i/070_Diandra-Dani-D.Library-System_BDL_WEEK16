from flask import Flask, render_template, request, redirect, url_for, flash
import mysql.connector
from mysql.connector import errorcode
from datetime import date, timedelta

app = Flask(__name__)
app.secret_key = 'dev'

config = {
    'user':'root','password':'','host':'127.0.0.1','database':'library_system'
}

def get_db():
    cnx = mysql.connector.connect(**config)
    return cnx

@app.route('/')
def index():
    q = request.args.get('q','')
    cnx = get_db(); cur = cnx.cursor(dictionary=True)
    if q:
        like = f"%{q}%"
        cur.execute("SELECT * FROM books WHERE title LIKE %s OR author LIKE %s OR isbn LIKE %s", (like,like,like))
    else:
        cur.execute("SELECT * FROM books")
    books = cur.fetchall(); cur.close(); cnx.close()
    return render_template('index.html', books=books, q=q)

@app.route('/add', methods=['GET','POST'])
def add():
    if request.method == 'POST':
        title = request.form['title']
        author = request.form.get('author')
        isbn = request.form.get('isbn')
        year = request.form.get('year')
        copies = int(request.form.get('copies',1))
        cnx = get_db(); cur = cnx.cursor()
        cur.execute("INSERT INTO books (title, author, isbn, year, copies) VALUES (%s,%s,%s,%s,%s)", (title,author,isbn,year,copies))
        cnx.commit(); cur.close(); cnx.close()
        return redirect(url_for('index'))
    return render_template('form.html')

# Loans routes
@app.route('/loans')
def loans():
    cnx = get_db(); cur = cnx.cursor(dictionary=True)
    cur.execute("SELECT l.id AS loan_id, b.title, s.name AS student_name, l.loan_date, l.due_date, l.returned, overdue_days(l.id) AS overdue_days FROM loans l JOIN books b ON l.book_id=b.id JOIN students s ON l.student_id=s.id ORDER BY l.created_at DESC")
    loans = cur.fetchall(); cur.close(); cnx.close()
    return render_template('loans.html', loans=loans)

@app.route('/lend', methods=['GET','POST'])
def lend():
    cnx = get_db(); cur = cnx.cursor(dictionary=True)
    cur.execute("SELECT b.*, (b.copies - IFNULL((SELECT COUNT(*) FROM loans l WHERE l.book_id=b.id AND l.returned=0),0)) AS available FROM books b ORDER BY b.title")
    books = cur.fetchall()
    cur.execute("SELECT * FROM students ORDER BY name")
    students = cur.fetchall(); cur.close(); cnx.close()
    if request.method=='POST':
        book_id = int(request.form['book_id'])
        student_id = int(request.form['student_id'])
        due_date = request.form['due_date']
        cnx = get_db(); cur = cnx.cursor()
        try:
            cur.callproc('lend_book', [book_id, student_id, due_date])
            cnx.commit()
        except Exception as e:
            flash(str(e))
        finally:
            cur.close(); cnx.close()
        return redirect(url_for('loans'))
    return render_template('lend.html', books=books, students=students)

@app.route('/return', methods=['POST'])
def return_loan():
    loan_id = int(request.form.get('loan_id',0))
    if loan_id:
        cnx = get_db(); cur = cnx.cursor()
        try:
            cur.callproc('return_book', [loan_id])
            cnx.commit()
        except Exception as e:
            flash(str(e))
        finally:
            cur.close(); cnx.close()
    return redirect(url_for('loans'))

if __name__=='__main__':
    app.run(debug=True)
