/*******************************************************************
 * 
 * Class:          CIS665
 * Assignment:     Course Project
 * Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
 * Due Date:       5.24.2019 @ 11:59pm
 *
 * Filename:       IIocBuildProcessor.java
 *   
 *   Interface which defines a "BuildProcessor".  This is as simple
 *   as it gets.  This interface facilitates the use of Inversion of
 *   Control (aka  Dependency Injection).
 *   
 *******************************************************************/

package com.cis665.demo.BuildProcessor;

public interface IIocBuildProcessor {
	
	// Method used to indicate a 'heart-beat' action to periodically
	// test if the build processor is alive
	String heartBeat();
	
}
