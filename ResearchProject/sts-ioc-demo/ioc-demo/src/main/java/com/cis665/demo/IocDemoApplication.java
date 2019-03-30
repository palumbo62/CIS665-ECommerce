/*******************************************************************
 * 
 * Class:          CIS665
 * Assignment:     Course Project
 * Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
 * Due Date:       5.24.2019 @ 11:59pm
 *
 * Filename:       IocDemoApplication.java
 *   
 *   Spring Boot application entry point.  Gets the app up and 
 *   running.
 *   
 *******************************************************************/
 
package com.cis665.demo;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;

@SpringBootApplication
public class IocDemoApplication {

	public static void main(String[] args) {
		SpringApplication.run(IocDemoApplication.class, args);
	}

}
