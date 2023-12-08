// App.jsx
import { useState } from 'react';
import './App.css';
import logo from './assets/ldaddy.png'
import member1 from './assets/team_member1.jpg'
import member2 from './assets/team_member2.jpg'
import member3 from './assets/team_member3.jpg'
import facebook from './assets/facebook_icon.png'
import twitter from './assets/twitter_icon.png'
import instagram from './assets/instagram_icon.png'

function App() {
  const [count, setCount] = useState(0);

  return (
    <>
      <nav>
        <div className="navbar">
          <div className="logo">
            <a href="#">
              <img src={logo} className="logo" alt="LoanDaddy Logo" />
            </a>
          </div>
          <ul className="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="applyLender.php">Join our Team</a></li>
            <li><a href="#footer">Contact Us</a></li>
            <li><a href="AboutUsPage.php">About Us</a></li>
            <li><a href="FAQsPage.php">FAQs</a></li>
            <li><a href="Loginpage.php">Login</a></li>
          </ul>
        </div>
      </nav>

      <div className="content-container">
        <div className="about-us-container">
          <h2>About Us</h2>

          <div className="about-section">
            <div className="left-section">
              <h3>Who we are?</h3>
              <p>Welcome to LoanDaddy, where we understand that borrowing money is a common necessity in life. Founded with a mission to provide efficient and secure loan transactions, we cater to the financial needs of individuals and businesses.</p>
            </div>

            <div className="right-section">
              <h3>Our Story</h3>
              <p>In a world where expenses are constant, LoanDaddy emerged to address the challenges faced by individuals and businesses in securing loans. Whether it's for business expansion, unexpected expenses, or personal needs, we aim to simplify the loaning process.</p>
            </div>
          </div>

          <div className="team-section">
            <h3>Our Team</h3>
            <div className="team-members">
              <div className="team-member">
                <img src={member2} alt="Team Member 1" />
                <p><b>Peter Abangan</b></p>
              </div>
              <div className="team-member">
                <img src={member1} alt="Team Member 2" />
                <p><b>Mark Calzada</b></p>
                <p>Team Leader</p>
              </div>
              <div className="team-member">
                <img src={member3} alt="Team Member 3" />
                <p><b>Athena Uy</b></p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer id="footer">
        <div className="footer-container">
          <div className="footer-column">
            <h4 style={{ fontWeight: 'bold', fontSize: '20px' }}>Navigate</h4>
            <ul>
              <li><a href="../php/index.php">Home</a></li>
              <li><a href="#footer">Contact Us</a></li>
              <li><a href="../php/AboutUsPage.php">About Us</a></li>
              <li><a href="../php/FAQsPage.php">FAQs</a></li>
            </ul>
          </div>
          <div className="footer-column">
            <h4 style={{ fontWeight: 'bold' }}><a href="../php/PrivacyPage.php">LoanDaddy Policy</a></h4>
            <ul>
              <li><a href="../php/PrivacyPage.php">Data Privacy Statement</a></li>
              <li><a href="../php/PrivacyPage.php">Terms of Use</a></li>
            </ul>
          </div>
          <div className="footer-column">
            <h4 style={{ fontWeight: 'bold', fontSize: '20px' }}>Connect With Us</h4>
            <div className="social-icons">
              <a href="https://www.facebook.com/markdavid.calzada" target="_blank" rel="noopener noreferrer" title="Facebook">
                <img src={facebook} alt="Facebook" />
              </a>
              <a href="https://www.instagram.com/marck_road/" target="_blank" rel="noopener noreferrer" title="Instagram">
                <img src={instagram} alt="Instagram" />
              </a>
              <a href="https://twitter.com/loan_daddy" target="_blank" rel="noopener noreferrer" title="Twitter">
                <img src={twitter} alt="Twitter" />
              </a>
            </div>
          </div>
          <div className="footer-column">
            <img src="./images/Logo.png" alt="Your Logo" className="footer-logo" />
            <ul>
              <li><a href="#">6014 Cebu<br />728 M. L. Quezon Ave</a></li>
              <li><a href="#">+63 995 521 4124</a></li>
              <li><a href="#">+63 995 221 9952</a></li>
              <li><a href="mailto:loandaddybusiness@gmail.com">loandaddybusiness@gmail.com</a></li>
            </ul>
          </div>
        </div>
      </footer>
    </>
  );
}

export default App;
